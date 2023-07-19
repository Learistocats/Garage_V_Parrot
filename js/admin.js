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
    var id = "row-" + rowId;
    var action = "delete";
    var element = document.getElementById(id)
    if (element) {
        element.remove();
    }

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            var rowToDelete = document.getElementById("row-" + rowId);
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
    var id = "row-" + rowId;
    var action = "delete";
    var element = document.getElementById(id)
    if (element) {
        element.remove();
    }

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            var rowToDelete = document.getElementById("row-" + rowId);
            if (rowToDelete) {
                rowToDelete.remove();
            }
        }
    };

    xhttp.open("GET", "../scripts/occasions_action.php?id=" + rowId + "&action=" + action, true);
    xhttp.send();
}

var droppedFiles = [];

function openOccasionsForm() {
    var popup = document.getElementById("formPopup");
    popup.style.display = "block";
}

function allowDrop(event) {
    event.preventDefault();
}

function handleDrop(event) {
    event.preventDefault();
    var files = event.dataTransfer.files;
    for (var i = 0; i < files.length; i++) {
        if (droppedFiles.length < 5) {
            droppedFiles.push(files[i]);
            // Display file names (optional)
            console.log("File added: " + files[i].name);
        } else {
            console.log("Maximum 5 files allowed.");
        }
    }
}

function submitOccasionsForm() {
    var form = document.getElementById("myForm");
    var formData = new FormData(form);

    // Append the droppedFiles to the formData
    for (var i = 0; i < droppedFiles.length; i++) {
        formData.append("images[]", droppedFiles[i]);
    }

    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Handle the server response here
            console.log(this.responseText);
        }
    };

    xhttp.open("POST", "handle_form.php", true);
    xhttp.send(formData);
}

