<?php
class Database {
    private $servername = "localhost";
    private $dbusername = "root";
    private $dbpassword = "password";
    private $database = "strikemaster_db";
    private $conn;
    private static $instance = null;
    public function __construct() {
        $this->connect();
    }
    public function checkReservations(): void {
        $sql = "DELETE FROM dpp_reservations WHERE created < NOW() - INTERVAL 10 MINUTE AND status = 'NEOVĚŘENO'";
        $this->executeQuery($sql);
    }
    public static function getInstance() : Database {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    private function connect(): void {
        $this->conn = new mysqli($this->servername, $this->dbusername, $this->dbpassword, $this->database);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
    public function checkTables(): void {
        $tableDefinitions = [
            DB_PREFIX."_users" => [
                'columns' => "id INT AUTO_INCREMENT, username VARCHAR(255), password VARCHAR(255), PRIMARY KEY (id)",
                'rows' => [
                    ['username' => 'root', 'password' => '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8']
                ]
            ],
            DB_PREFIX."_reservations" => [
                'columns' => "id INT AUTO_INCREMENT PRIMARY KEY, 
                  month TINYINT UNSIGNED NOT NULL, 
                  day TINYINT UNSIGNED NOT NULL, 
                  timeStart TIME NOT NULL, 
                  timeEnd TIME NOT NULL, 
                  track TINYINT UNSIGNED NOT NULL, 
                  firstName VARCHAR(50) NOT NULL, 
                  lastName VARCHAR(50) NOT NULL, 
                  email VARCHAR(70) NOT NULL,
                  created DATETIME NOT NULL,
                  price INT NOT NULL,
                  status VARCHAR(25) NOT NULL"
            ],
            DB_PREFIX."_allowed_file_types" => [
                'columns' => "id INT AUTO_INCREMENT, filetype VARCHAR(255), mimetype VARCHAR(255), PRIMARY KEY (id)",
                'rows' => [
                    ['filetype' => 'css', 'mimetype' => 'text/css'],
                    ['filetype' => 'js', 'mimetype' => 'text/javascript'],
                    ['filetype' => 'svg', 'mimetype' => 'image/svg+xml'],
                    ['filetype' => 'png', 'mimetype' => 'image/png'],
                    ['filetype' => 'jpg', 'mimetype' => 'image/jpeg'],
                    ['filetype' => 'webp', 'mimetype' => 'image/webp']
                ]
            ],
        ];
        foreach ($tableDefinitions as $tableName => $definition) {
            $result = $this->select("`information_schema`.`columns`", ["*"], "table_schema = ? AND table_name = ?", [$this->database, $tableName], true);
            if (!$result) {
                $sql = "CREATE TABLE {$tableName} ({$definition['columns']})";
                $this->executeQuery($sql);
                if($definition['rows']) {
                    foreach ($definition['rows'] as $row) {
                        $columns = implode(', ', array_keys($row));
                        $placeholders = implode(', ', array_fill(0, count($row), '?'));
                        $sql = "INSERT INTO {$tableName} ({$columns}) VALUES ({$placeholders})";
                        $this->executeQuery($sql, array_values($row));
                    }
                }
            }
        }
    }
    public function select(string $dbname, array $columns, ?string $condition, ?array $params, bool $singleRow = false): null|array|string {
        $columnsStr = implode(",", $columns);
        $sql = "SELECT {$columnsStr} FROM {$dbname}";
        if(!empty($condition)) {
            $sql .= " WHERE {$condition}";
        }
        if($params) {
            foreach($params as &$param) {
                $param = $this->sanatize($param);
            }
        }
        $result = $this->executeQuery($sql, $params);
        if(!$result) {
            return null;
        }
        if($singleRow) {
            return $this->fetchRow($result);
        } else return $this->fetchRows($result);
    }
    public function insert(string $dbname, array $columns, array $values): bool {
        $columnsStr = implode(",", $columns);
        $placeholders = implode(",", array_fill(0, count($values), '?'));
        $sql = "INSERT INTO {$dbname} ({$columnsStr}) VALUES ({$placeholders})";
        foreach ($values as &$value) {
            $value = $this->sanatize($value);
        }
        return $this->executeQuery($sql, $values, false);
    }
    public function update(string $dbname, array $columns, array $values, string $condition, array $params): bool {
        $setClauses = [];
        foreach ($columns as $column) {
            $setClauses[] = "{$column} = ?";
        }
        $setStr = implode(",", $setClauses);
        $sql = "UPDATE {$dbname} SET {$setStr} WHERE {$condition}";
        foreach ($values as &$value) {
            $value = $this->sanatize($value);
        }
        foreach ($params as &$param) {
            $param = $this->sanatize($param);
        }
        $allParams = array_merge($values, $params);
        return $this->executeQuery($sql, $allParams);
    }
    public function delete(string $dbname, string $condition, array $params): bool {
        $sql = "DELETE FROM {$dbname} WHERE {$condition}";
        foreach ($params as &$param) {
            $param = $this->sanatize($param);
        }

        return $this->executeQuery($sql, $params, false);
    }
    public function fetchRows($result): array|null {
        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }
    public function fetchRow($result): array|null {
        if ($row = $result->fetch_assoc()) {
            return $row;
        }
        return null;
    }
    private function disconnect() {
        $this->conn->close();
    }
    // for non-select queries, set returnResult to false on call.
    public function executeQuery($sql, $params = [], $returnResult = true) {
        $stmt = $this->conn->prepare($sql);
        if (!empty($params)) {
            $types = '';
            $bindParams = [&$types];
            foreach ($params as &$param) {
                if (is_int($param)) {
                    $types .= 'i';
                } elseif (is_float($param)) {
                    $types .= 'd';
                } elseif (is_string($param)) {
                    $param = $this->sanatize($param);
                    $types .= 's';
                } else {
                    $types .= 'b';
                }
                $bindParams[] = &$param;
            }
            call_user_func_array([$stmt, 'bind_param'], $bindParams);
        }
        $stmt->execute();
        if ($stmt->error) {
            return false;
        }
        if ($returnResult) {
            $result = $stmt->get_result();
            if ($result === false) {
                return false;
            }
            return $result;
        }
        $success = $stmt->affected_rows > 0;
        $stmt->close();
        return $success;
    }
    public function fetchSingleRow($result) {
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
    public function sanatize($string): string
    {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }
    public function getLastInsertedId(): int {
        return $this->conn->insert_id;
    }
}