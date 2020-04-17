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
	let newtv = document.getElementById('model');
	let newMarque= document.getElementById('brand');
	let newTaill	= document.getElementById('size');
	let newEcran	= document.getElementById('screen');
	let newResolution	= document.getElementById('resolution');
	let newPrix = document.getElementById('price');
	let	newQuantity= document.getElementById('newQuantity');
    		 		
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

function addPoints() {
	let points = document.getElementById('tankPoints').value;
	if(points <=0 ){
		alert('error must be upper than 0');
		return false; 
	}
	console.log(points);
	let request = new XMLHttpRequest();
	request.open("POST", "profilAjaxProcess.php", true);   
	request.onreadystatechange = function() {
		if(request.readyState == 4) {
			if(request.status == 200) {
				console.log(request.response);
				
                let containeurPoints = document.getElementById('points');
                containeurPoints.innerHTML = request.response; 
			} else {
				alert("Error: returned status code " + request.status + " " + request.statusText);
			}
		}
	}
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(`addPoints=${points}&mail=${mail}`);
}
function removePoints() {
	let points = document.getElementById('tankPoints').value;
	if(points <=0 ){
		alert('error must be upper than 0 even to remove points');
		return false;
	}
	console.log(points);
	let request = new XMLHttpRequest();
	request.open("POST", "profilAjaxProcess.php", true);   
	request.onreadystatechange = function() {
		if(request.readyState == 4) {
			if(request.status == 200) {
				console.log(request.response);
				
                let containeurPoints = document.getElementById('points');
                containeurPoints.innerHTML = request.response; 
			} else {
				alert("Error: returned status code " + request.status + " " + request.statusText);
			}
		}
	}
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(`removePoints=${points}&mail=${mail}`);
}
function ChangeUserLevel() {
	let newLevel = document.getElementById('levelSelected').value;
	let request = new XMLHttpRequest();
	request.open("POST", "profilAjaxProcess.php", true);   
	request.onreadystatechange = function() {
		if(request.readyState == 4) {
			if(request.status == 200) {
				let containeurNamelevel = document.getElementById('level');
				let containeurPointslevel = document.getElementById('points');
				let ObjJson = JSON.parse(request.responseText);
				console.log(ObjJson.newUserLevel + '\n');
				console.log(ObjJson.threshold + '\n');
				containeurNamelevel.innerHTML = ObjJson.newUserLevel; 
				containeurPointslevel.innerHTML = ObjJson.threshold; 
			} else {
				alert("Error: returned status code " + request.status + " " + request.statusText);
			}
		}
	}
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(`newUserLevel=${newLevel}&mail=${mail}`);
}

function banne() {
	let days = document.getElementById('days').value;
	console.log(typeof days);
	if(typeof days == Number) {
		days = (parseInt(days)*10)%10;
		console.log('ok');
		console.log(days);
	}
	let request = new XMLHttpRequest();
	request.open("POST", "profilAjaxProcess.php", true);   
	request.onreadystatechange = function() {
		if(request.readyState == 4) {
			if(request.status == 200) {
				alert("l'utilisateur est plus bannie");
				location.reload();
			} else {
				alert("Error: returned status code " + request.status + " " + request.statusText);
			}
		}
	}
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(`banneDays=${days}&mail=${mail}`);
}

function endBanne() {
	let request = new XMLHttpRequest();
	request.open("POST", "profilAjaxProcess.php", true);   
	request.onreadystatechange = function() {
		if(request.readyState == 4) {
			if(request.status == 200) {
				alert("l'utilisateur n'est plus bannie");
				location.reload();
			} else {
				alert("Error: returned status code " + request.status + " " + request.statusText);
			}
		}
	}
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(`endBan=${1}&mail=${mail}`);
}


///////////////////////////////////////////////////////////////////////////////////////////

	 //-----------------------------for repporthandling.php----------------------------//

function suppTopic() {
	let idTopic = document.getElementById('numId').innerHTML;
	let reportAuthor = document.getElementById('idRepoter').innerHTML;
	console.log(idTopic);
	let request = new XMLHttpRequest();  
	request.open("POST", "reportHandlingAjaxProcess.php", true); 
	request.onreadystatechange = function() {
		if(request.readyState == 4) {
			if(request.status == 200) {
                let containeurActive = document.getElementById('active');
				containeurActive.innerHTML = request.response;
				window.location.href='reportList.php';
			} else {
				alert("Error: returned status code " + request.status + " " + request.statusText);
			}
		}
	}
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(`idTopic=${idTopic}&reporter=${reportAuthor}&option=${1}`);
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



function suppEnigma() {
	let idEnigma = document.getElementById('numId').innerHTML;
	let reportAuthor = document.getElementById('idRepoter').innerHTML;
	let badUser = document.getElementById('emailBadUser').innerHTML;
	console.log(idEnigma);
	console.log(reportAuthor);
	let request = new XMLHttpRequest();  
	request.open("POST", "reportHandlingAjaxProcess.php", true); 
	request.onreadystatechange = function() {
		if(request.readyState == 4) {
			if(request.status == 200) {
				let containeurActive = document.getElementById('active');
				console.log(containeurActive);
				
				containeurActive.innerHTML = request.response;
				window.location.href='UserProfile.php?email=' + badUser;
			} else {
				alert("Error: returned status code " + request.status + " " + request.statusText);
			}
		}
	}
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(`idEnigma=${idEnigma}&reporter=${reportAuthor}&option=${3}`);
}

function keepEnigma() {
	let idEnigma = document.getElementById('numId').innerHTML;
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
    request.send(`idEnigma=${idEnigma}&reporter=${reportAuthor}&option=${4}`);
}