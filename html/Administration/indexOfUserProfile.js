removeElement = (idContaineur) => {
	const div = document.getElementById(idContaineur);
    div.innerHTML = "";
}
emailChange = () => {
	let oldEmail = document.getElementById('userEmail').innerHTML;
	console.log('contenue de oldEmail = '+ oldEmail);
	let newMail = document.getElementById('newMail').value;
	console.log('newEmail = ' + newmail);
	let request1 = new XMLHttpRequest();  
	request1.onreadystatechange = function() {
		if(request1.readyState == 4) {
			if(request1.status == 200) {
				removeElement('userEmail');
				let containeur = document.getElementById('userEmail');
				console.log('une fois la requet effectué containeur = ' + containeur);
				console.log( 'response =' +request1.responseText);
                containeur.innerHTML = request1.responseText;
			} else {
				alert("Error: returned status code " + request1.status + " " + request1.statusText);
			}
		}
	}
	request1.open("POST", "usersEmailProcess.php", true);
	request1.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	request1.send(`newEmail=${newMail}&oldEmail=${oldEmail}`);
}
