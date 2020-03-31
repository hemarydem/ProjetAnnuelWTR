let mail =  document.getElementById('mail').innerHTML;




function changeModerator() {
    let moderator = document.getElementById('moderator');

    
	let request = new XMLHttpRequest();  
	request.onreadystatechange = function() {
		if(request.readyState == 4) {
			if(request.status == 200) {

                moderator.innerHTML = request.response;
  
			} else {
				alert("Error: returned status code " + request.status + " " + request.statusText);
			}
		}
	}
	request.open("POST", "profilAjaxProcess.php", true); 
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(`mail=${mail}&moderator=${moderator.innerHTML}`);
}

function changeactive() {
    let active = document.getElementById('active');

    
	let request = new XMLHttpRequest();  
	request.onreadystatechange = function() {
		if(request.readyState == 4) {
			if(request.status == 200) {
                
                active.innerHTML = request.response;
                
			} else {
				alert("Error: returned status code " + request.status + " " + request.statusText);
			}
		}
	}
	request.open("POST", "profilAjaxProcess.php", true); 
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(`mail=${mail}&active=${active.innerHTML}`);
}


function changeEmail() {
    let newMail = document.getElementById('newMail').value;
    
	let request = new XMLHttpRequest();  
	request.onreadystatechange = function() {
		if(request.readyState == 4) {
			if(request.status == 200) {                
                document.location.href="UserProfile.php?email=" + newMail;
                
			} else {
				alert("Error: returned status code " + request.status + " " + request.statusText);
			}
		}
	}
	request.open("POST", "profilAjaxProcess.php", true); 
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(`mail=${mail}&newMail=${newMail}`);

    
}

function changeLogin() {

    let newLogin = document.getElementById('newLogin').value;
	let request = new XMLHttpRequest();  
	request.onreadystatechange = function() {
		if(request.readyState == 4) {
			if(request.status == 200) {
                let containeurLogin = document.getElementById('login');
                containeurLogin.innerHTML = request.response; 
			} else {
				alert("Error: returned status code " + request.status + " " + request.statusText);
			}
		}
	}
	request.open("POST", "profilAjaxProcess.php", true); 
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(`mail=${mail}&newLogin=${newLogin}`);
}