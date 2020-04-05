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

function suppLevel() {
	let inputOption = document.getElementById('supp').value;
	let request = new XMLHttpRequest();  
	request.onreadystatechange = function() {
		if(request.readyState == 4) {
			if(request.status == 200) {
				let statusLevel = request.response;
				console.log(statusLevel);
				console.log(typeof(statusLevel))
				
				switch (statusLevel) {
					//error in the supp process
					case '0':
						alert("erreur niveau non supprimer");
						break;
					// the level is deleted
					case '1':
						alert("le niveau a bien été supprimer");
						window.location.replace("http://localhost:8888/levelSearch.php");//peut être CHANGER
						break;															// ADRESSE POUR integration 
					// the user did not wrote one in the input
					case '2':
						alert("Vous n'avez pas rentré 1");
						break;
				}
				
			} else {
				alert("Error: returned status code " + request.status + " " + request.statusText);
			}
		}
	}
	request.open("POST", "levelManageProcess.php", true); 
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(`idLevel=${idLevel}&option=${inputOption}`);
}