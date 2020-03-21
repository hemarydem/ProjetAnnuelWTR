removeElement = (idContaineur) => {
	const div = document.getElementById(idContaineur);
    div.innerHTML = "";
}
emailChange = () => {
	let oldEmail = document.getElementById('userEmail').innerHTML;
	console.log('contenue de oldEmail = '+)
	let newemail = document.getElementById('newMail').value;
	let request1 = new XMLHttpRequest();  
	request1.onreadystatechange = function() {
		if(request1.readyState == 4) {
			if(request1.status == 200) {
				removeElement('userEmail');
                let containeur = document.getElementById('userEmail');
                containeur.innerHTML = request1.responseText;
			} else {
				alert("Error: returned status code " + request1.status + " " + request1.statusText);
			}
		}
	}
	request1.open("POST", "usersEmailProcess.php", true);
	request1.setRequestHeader("Content-Type", "");
	request1.send(`newEmail=${newemail}&oldEmail=${oldemail}`);
}
