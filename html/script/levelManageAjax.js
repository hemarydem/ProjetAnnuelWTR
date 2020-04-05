let idLevel =  document.getElementById('idLevel').innerHTML;

function changeLevelName() {
    let name = document.getElementById('name');
    let newName = document.getElementById('newName').value;
    
	let request = new XMLHttpRequest();  
	request.onreadystatechange = function() {
		if(request.readyState == 4) {
			if(request.status == 200) {
                name.innerHTML = request.response;
			} else {
				alert("Error: returned status code " + request.status + " " + request.statusText);
			}
		}
	}
	request.open("POST", "levelManageProcess.php", true); 
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(`idLevel=${idLevel}&name=${newName}`);
}

function changeThreshold() {
    let threshold = document.getElementById('threshold');
    let newThreshold = document.getElementById('newThreshold').value;
	let request = new XMLHttpRequest();  
	request.onreadystatechange = function() {
		if(request.readyState == 4) {
			if(request.status == 200) {
                threshold.innerHTML = request.response;
			} else {
				alert("Error: returned status code " + request.status + " " + request.statusText);
			}
		}
	}
	request.open("POST", "levelManageProcess.php", true); 
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(`idLevel=${idLevel}&threshold=${newThreshold}`);
}