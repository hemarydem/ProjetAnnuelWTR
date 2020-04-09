//this file is also use for repporthandling.php
let mail =  document.getElementById('mail').innerHTML;



// this function change the status in bdd
//turn on or turn of off by switching the data from 0 to 1 vice and versa
function changeModerator() {
    let moderator = document.getElementById('moderator');
	let request = new XMLHttpRequest();  
	request.open("POST", "profilAjaxProcess.php", true); 
	request.onreadystatechange = function() {
		if(request.readyState == 4) {
			if(request.status == 200) {
                moderator.innerHTML = request.response;
			} else {
				alert("Error: returned status code " + request.status + " " + request.statusText);
			}
		}
	}
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(`mail=${mail}&moderator=${moderator.innerHTML}`);
}
// this function change the status in bdd
//turn on or turn of off by switching the data from 0 to 1 vice and versa
function changeactive() {
    let active = document.getElementById('active');
    
	let request = new XMLHttpRequest();
	request.open("POST", "profilAjaxProcess.php", true);   
	request.onreadystatechange = function() {
		if(request.readyState == 4) {
			if(request.status == 200) {
                
                active.innerHTML = request.response;
                
			} else {
				alert("Error: returned status code " + request.status + " " + request.statusText);
			}
		}
	}
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(`mail=${mail}&active=${active.innerHTML}`);
}

function changeEmail() {
    let newMail = document.getElementById('newMail').value;
    
	let request = new XMLHttpRequest();
	request.open("POST", "profilAjaxProcess.php", true);   
	request.onreadystatechange = function() {
		if(request.readyState == 4) {
			if(request.status == 200) {                
                document.location.href="UserProfile.php?email=" + newMail;
                
			} else {
				alert("Error: returned status code " + request.status + " " + request.statusText);
			}
		}
	}
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(`mail=${mail}&newMail=${newMail}`);    
}

function changeLogin() {

    let newLogin = document.getElementById('newLogin').value;
	let request = new XMLHttpRequest();
	request.open("POST", "profilAjaxProcess.php", true);   
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
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(`mail=${mail}&newLogin=${newLogin}`);
}
///////////////////////////////////////////////////////////////////////////////////////////

	 //-----------------------------for repporthandling.php----------------------------//

function suppTopic() {
	let idTopic = document.getElementById('numId').innerHTML;
	console.log(idTopic);
	let request = new XMLHttpRequest();  
	request.open("POST", "reportHandlingAjaxProcess.php", true); 
	request.onreadystatechange = function() {
		if(request.readyState == 4) {
			if(request.status == 200) {
                let containeurActive = document.getElementById('active');
				containeurActive.innerHTML = request.response; 
			} else {
				alert("Error: returned status code " + request.status + " " + request.statusText);
			}
		}
	}
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(`idTopic=${idTopic}&option=${1}`);
}

function keepTopic() {
	let idTopic = document.getElementById('numId').innerHTML;
	let reportAuthor = document.getElementById('idRepoter').innerHTML;
	let request = new XMLHttpRequest();  
	request.open("POST", "reportHandlingAjaxProcess.php", true); 
	request.onreadystatechange = function() {
		if(request.readyState == 4) {
			if(request.status == 200) {
				window.location.href='reportList.php';
			} else {
				alert("Error: returned status code " + request.status + " " + request.statusText);
			}
		}
	}
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(`idTopic=${idTopic}&reporter=${reportAuthor}&option=${2}`);
}