<?php
include_once("db.php");
include_once("config.php");
class router {
    private $db;
    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->db->checkTables();
        $parsedURL = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        $this->checkAllowedFileTypes($parsedURL);
        $this->checkNormalRoutes();
        $this->checkAdminRoutes();
        $this->not_found();
    }
    private function checkAdminRoutes(): void {
        $this->get("/admin/login", "views/admin/adminLogin.php");
        $this->post("/admin/auth", "actions/admin/login.php");
        $this->adminMiddleware();
        $this->get("/admin", "views/admin/admin.php");
        $this->get("/admin/reservations", "views/admin/reservations.php");
        $this->getpost("/admin/logoff", "actions/admin/logout.php");
    }
    private function checkNormalRoutes(): void {
        $this->get("/", "views/index.php");
        $this->get("/kontakt", "views/kontakt.php");
        $this->post("/get-times", "actions/getTimes.php");
        $this->post("/make-reservation", "actions/makeReservation.php");
    }
    private function checkAllowedFileTypes($parsedURL): void
    {
        $allowedFileTypes = [];
        $results = $this->db->select(DB_PREFIX."_allowed_file_types", ["*"], null, null);
        foreach ($results as $result) {
            $allowedFileTypes[$result["filetype"]] = $result["mimetype"];
        }
        if (array_key_exists(pathinfo($parsedURL, PATHINFO_EXTENSION), $allowedFileTypes)) {
            $filepath = "." . $parsedURL;
            if (file_exists($filepath)) {
                header("Content-Type: " . $allowedFileTypes[pathinfo($filepath, PATHINFO_EXTENSION)]);
                readfile($filepath);
                exit();
            } else {
                $this->not_found();
            }
        }
    }
    private function get($route, $path_to_include): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->route($route, $path_to_include);
        }
    }
    private function post($route, $path_to_include): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->route($route, $path_to_include);
        }
    }
    private function getpost($route, $path_to_include): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' || $_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->route($route, $path_to_include);
        }
    }
    private function route($route, $path_to_include): void
    {
        $callback = $path_to_include;
        if (!is_callable($callback)) {
            if (!strpos($path_to_include, '.php')) {
                $path_to_include .= '.php';
            }
        }
        if ($route == "/404") {
            include_once __DIR__ . "/$path_to_include";
            exit();
        }
        $request_url = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
        $request_url = rtrim($request_url, '/');
        $request_url = strtok($request_url, '?');
        $route_parts = explode('/', $route);
        $request_url_parts = explode('/', $request_url);
        array_shift($route_parts);
        array_shift($request_url_parts);
        if ($route_parts[0] == '' && count($request_url_parts) == 0) {
            // Callback function
            if (is_callable($callback)) {
                call_user_func_array($callback, []);
                exit();
            }
            include_once __DIR__ . "/$path_to_include";
            exit();
        }
        if (count($route_parts) != count($request_url_parts)) {
            return;
        }
        $parameters = [];
        for ($__i__ = 0; $__i__ < count($route_parts); $__i__++) {
            $route_part = $route_parts[$__i__];
            if (preg_match("/^[$]/", $route_part)) {
                $route_part = ltrim($route_part, '$');
                $parameters[] = $request_url_parts[$__i__];
                $$route_part = $request_url_parts[$__i__];
            } else if ($route_parts[$__i__] != $request_url_parts[$__i__]) {
                return;
            }
        }
        // Callback function
        if (is_callable($callback)) {
            call_user_func_array($callback, $parameters);
            exit();
        }

        include_once __DIR__ . "/$path_to_include";
        exit();
    }
    private function out($text): void
    {
        echo htmlspecialchars($text);
    }
    private function set_csrf(): void
    {
        session_start();
        if (!isset($_SESSION["csrf"])) {
            $_SESSION["csrf"] = bin2hex(random_bytes(50));
        }
        echo '<input type="hidden" name="csrf" value="' . $_SESSION["csrf"] . '">';
    }
    private function is_csrf_valid(): bool
    {
        session_start();
        if (!isset($_SESSION['csrf']) || !isset($_POST['csrf'])) {
            return false;
        }
        if ($_SESSION['csrf'] != $_POST['csrf']) {
            return false;
        }
        return true;
    }
    private function not_found(): void {
        http_response_code(404);
        die();
    }
    private function adminMiddleware(): void {
        //session is started on every ADMIN page due to this function.
        session_start();
        if(!isset($_SESSION["admin"])) {
            header("location: /admin/login");
        }
    }
}
$router = new router();