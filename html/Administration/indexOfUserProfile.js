removeElement = (idContaineur) => {
	const div = document.getElementById(idContaineur);
    div.innerHTML = "";
}
emailChange = () => {
	let request = new XMLHttpRequest();  
	let actualMail = document.getElementById('userEmail').innerHTML;
	console.log(actualMail);
	let inputMail =  document.getElementById('newMail').value;
	console.log(inputMail);
	request.onreadystatechange = function() {
		if(request.readyState == 4) {
			if(request.status == 200) {
				removeElement('userEmail');
				let divEmail =  document.getElementById('userEmail');
				console.log(divEmail);
				divEmail.innerHTML = request.responseText;
				console.log(divEmail);
			} else {
				alert("Error: returned status code " + request.status + " " + request.statusText);
			}
		}
	}
	request.open("POST", "usersEmailProcess.php", true);    
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	request.send(`newEmail=${inputMail}&oldEmail=${actualMail}`);
}
