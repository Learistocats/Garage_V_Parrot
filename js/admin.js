function showContent(contentId) {
    // Hide all content blocks
    var contentBlocks = document.getElementsByClassName('content');
    for (var i = 0; i < contentBlocks.length; i++) {
        contentBlocks[i].style.display = 'none';
    }

    // Show the selected content block
    var selectedContent = document.getElementById(contentId);
    if (selectedContent) {
        selectedContent.style.display = 'block';
    }

    // Update the background color of the active button
    var navButtons = document.getElementsByClassName('nav-btn');
    for (var j = 0; j < navButtons.length; j++) {
        if (navButtons[j].id === contentId) {
            navButtons[j].style.backgroundColor = '#111111';
        } else {
            navButtons[j].style.backgroundColor = 'transparent';
        }
    }
}

function deleteRow(rowId) {
    var xhttp = new XMLHttpRequest();
    var id = "service-row-" + rowId;
    var action = "delete";
    var element = document.getElementById(id)
    if (element) {
        element.remove();
    }

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            var rowToDelete = document.getElementById(id);
            if (rowToDelete) {
                rowToDelete.remove();
            }
        }
    };

    xhttp.open("GET", "../scripts/services_action.php?id=" + rowId + "&action=" + action, true);
    xhttp.send();
}

function openForm() {
    document.getElementById("myForm").style.display = "block";
}

function closeForm() {
    document.getElementById("myForm").style.display = "none";
}

function closeOccasionForm() {
    document.getElementById("formPopup").style.display = "none";
}

function addService() {
        var form = document.getElementById("addServiceForm");
        var formData = new FormData(form);
    
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                var responseDiv = document.getElementById("response");
                responseDiv.innerHTML = this.responseText;
            }
        };
    
        xhttp.open("POST", "../scripts/services_action.php", true);
        xhttp.send(formData);
}

function deleteOccasionRow(rowId) {
    var xhttp = new XMLHttpRequest();
    var id = "occasion-row-" + rowId;
    var action = "delete";
    var element = document.getElementById(id)
    if (element) {
        element.remove();
    }

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            var rowToDelete = document.getElementById(id);
            if (rowToDelete) {
                rowToDelete.remove();
            }
        }
    };

    xhttp.open("GET", "../scripts/occasions_action.php?id=" + rowId + "&action=" + action, true);
    xhttp.send();
}

function openOccasionsForm() {
    var popup = document.getElementById("formPopup");
    popup.style.display = "block";
}

function submitOccasionsForm() {
    var form = document.getElementById("addOccasionForm");
    var formData = new FormData(form);

    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
        }
    };
    xhttp.open("POST", "../scripts/occasions_action.php", true);
    xhttp.send(formData);
}

function denyReview(rowId) {
    var xhttp = new XMLHttpRequest();
    var id = "review-row-" + rowId;
    var action = "deny";
    var element = document.getElementById(id)
    if (element) {
        element.remove();
    }

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            var rowToDelete = document.getElementById(id);
            if (rowToDelete) {
                rowToDelete.remove();
            }
        }
    };

    xhttp.open("GET", "../scripts/review_actions.php?id=" + rowId + "&action=" + action, true);
    xhttp.send();
}

function acceptReview(rowId) {
    var xhttp = new XMLHttpRequest();
    var id = "review-row-" + rowId;
    var action = "accept";
    var element = document.getElementById(id)
    if (element) {
        element.remove();
    }

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            var rowToDelete = document.getElementById(id);
            if (rowToDelete) {
                rowToDelete.remove();
            }
        }
    };

    xhttp.open("GET", "../scripts/review_actions.php?id=" + rowId + "&action=" + action, true);
    xhttp.send();
}

function openUserForm() {
    document.getElementById("userForm").style.display = "block";
}

function closeUserForm() {
    document.getElementById("userForm").style.display = "none";
}

function addUser() {
    var form = document.getElementById("addUserForm");
    var formData = new FormData(form);

    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function() {
        if (this.readyState === 4) {
            if (this.status === 200) {
                // Request was successful, handle the response (if needed)
                console.log('Response from PHP:', this.responseText);
            } else {
                // Request failed, handle the error (if needed)
                console.error('XMLHttpRequest error:', this.status, this.statusText);
            }
        }
    };

    xhttp.open("POST", "../scripts/user_action.php", true);
    xhttp.send(formData);
}

function showScheduleForm() {
    document.getElementById("scheduleForm").style.display = "block";
}

function closeScheduleForm() {
    document.getElementById("scheduleForm").style.display = "none";
}

function updateSchedule() {
    var form = document.getElementById("updateScheduleForm");
    var formData = new FormData(form);

    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function() {
        if (this.readyState === 4) {
            if (this.status === 200) {
                // Request was successful, handle the response (if needed)
                console.log('Response from PHP:', this.responseText);
            } else {
                // Request failed, handle the error (if needed)
                console.error('XMLHttpRequest error:', this.status, this.statusText);
            }
        }
    };

    xhttp.open("POST", "../scripts/schedule_action.php", true);
    xhttp.send(formData);
}

