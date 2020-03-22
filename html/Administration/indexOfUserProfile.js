function removeElement(idContaineur) {
	const div = document.getElementById(idContaineur);
    div.innerHTML = "";
}
function emailChange () {
	let actualMail = document.getElementById('userEmail').innerHTML;
	console.log(actualMail);
	const inputMail =  document.getElementById('newMail').value;
	console.log(inputMail);
	let request = new XMLHttpRequest();  
	request.onreadystatechange = function() {
		if(request.readyState == 4) {
			if(request.status == 200) {
				removeElement('userEmail');
				let divEmail =  document.getElementById('userEmail');
				console.log(divEmail);
				console.log('responseText = ' + request.responseText);
				divEmail.innerHTML = request.responseText;
				console.log(request.responseText);
				//emailInsert(inputMail);
			} else {
				alert("Error: returned status code " + request.status + " " + request.statusText);
			}
		}
	}
	request.open("POST", "usersEmailProcess.php", true);    
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	request.send(`newEmail=${inputMail}&oldEmail=${actualMail}`);
}
