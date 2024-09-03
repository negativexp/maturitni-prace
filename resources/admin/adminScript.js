const subnavs = document.querySelectorAll("nav .links .subnav")
const warningMessage = document.getElementById("warningMessage")
const warningMessageText = document.getElementById("warningMessageText")
const warningMessageInput = document.getElementById("warningMessageInput")
const warningMessageInput2 = document.getElementById("warningMessageInput2")

let activeLink = null
let activeSubnav = null
function toggleSubNav(id, link) {
    const subnav = document.getElementById(id);

    if (activeSubnav && activeSubnav !== subnav) {
        activeSubnav.classList.remove("open")
        //activeLink.classList.remove("active")
    }

    if (subnav.classList.contains("open")) {
        subnav.classList.remove("open")
        //link.classList.remove("active")
        activeSubnav = null
        //activeLink = null
    } else {
        subnav.classList.add("open")
        //link.classList.add("active")
        activeSubnav = subnav
        //activeLink = link
    }
}

function openWarning(message, value, value2) {
    warningMessageText.innerText = message
    warningMessage.style.display = "flex"
    warningMessageInput.value = value

    if (value2 !== null && value2 !== undefined) {
        warningMessageInput2.value = value2
    }
}
function closeWarning() {
    warningMessageText.innerText = ""
    warningMessage.style.display = "none"
}
function openForm(id) {
    document.getElementById(id).style.display = "flex"
}
function closeForm(id) {
    document.getElementById(id).style.display = "none"
}
function post(url, data) {
    fetch(url, {
        method: "POST",
        body: data
    }).then((response) => {
        //console.log(response)
        location.reload()
    }).catch((error) => {
        console.log("fetched error:", error)
    })
}

function showWarning(message, boldText, actionUrl, hiddenInputs, onContinue) {
    // Create the warning message structure
    var warningMessage = document.createElement('div');
    warningMessage.id = 'warningMessage';
    warningMessage.className = 'warning-message';

    var wrapper = document.createElement('div');
    wrapper.className = 'wrapper';

    var heading = document.createElement('h2');
    heading.textContent = 'Pozor!';

    var warningMessageText = document.createElement('p');
    warningMessageText.id = 'warningMessageText';
    warningMessageText.innerHTML = message.replace(boldText, '<b>' + boldText + '</b>');

    var form = document.createElement('form');
    form.method = 'post';
    form.action = actionUrl;

    var options = document.createElement('div');
    options.className = 'options';

    // Dynamically add hidden inputs based on the passed object
    for (var name in hiddenInputs) {
        if (hiddenInputs.hasOwnProperty(name)) {
            var hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = name;
            hiddenInput.value = hiddenInputs[name];
            form.appendChild(hiddenInput);
        }
    }

    var continueButton = document.createElement('input');
    continueButton.type = 'submit';
    continueButton.name = 'submit';
    continueButton.className = 'button';
    continueButton.value = 'Smazat';

    var cancelButton = document.createElement('a');
    cancelButton.className = 'button';
    cancelButton.textContent = 'Zrušit';
    cancelButton.href = 'javascript:void(0);';
    cancelButton.onclick = function() {
        closeWarning();
    };

    options.appendChild(continueButton);
    options.appendChild(cancelButton);
    form.appendChild(options);
    wrapper.appendChild(heading);
    wrapper.appendChild(warningMessageText);
    wrapper.appendChild(form);
    warningMessage.appendChild(wrapper);
    document.body.appendChild(warningMessage);

    continueButton.onclick = function(event) {
        if (typeof onContinue === 'function') {
            event.preventDefault();
            onContinue();
        }
    };
}

function closeWarning() {
    var warningMessage = document.getElementById('warningMessage');
    if (warningMessage) {
        document.body.removeChild(warningMessage);
    }
}

// Example usage
function onContinue() {
    alert('Continue action executed!');
}