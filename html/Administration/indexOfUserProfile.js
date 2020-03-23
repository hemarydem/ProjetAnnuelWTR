function removeElement(idContaineur) {
	const div = document.getElementById(idContaineur);
    div.innerHTML = "";
}
function emailChange () {
	let actualMail = document.getElementById('userEmail').innerHTML;
	console.log(actualMail);
	let inputMail =  document.getElementById('newMail').value;
	console.log(inputMail);
	let request = new XMLHttpRequest();  
	request.onreadystatechange = function() {
		if(request.readyState == 4) {
			if(request.status == 200) {
				//removeElement('userEmail');
				let divEmail = document.getElementById('userEmail');
				console.log(divEmail);
				console.log('responseText = ' + request.responseText);
				console.log('response = ' + request.response);
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
function emailChange2() {
	console.log('ok1');
	let actualMail = document.getElementById('userEmail').innerHTML;
	let inputMail =  document.getElementById('newMail').value;
    let request = new XMLHttpRequest();
    request.open('GET','usersEmailProcess2.php?newEmail='+inputMail+'&oldEmail='+actualMail);
    request.onreadystatechange = function() {
        console.log('ok1');
        if(request.readyState === 4){
            console.log('ok3');
            if(request.status == 200) {
				//removeElement('userEmail');
				let divEmail = document.getElementById('userEmail');
				console.log(divEmail);
				console.log('responseText = ' + request.responseText);
				console.log('response = ' + request.response);
				divEmail.innerHTML = request.responseText;
				console.log(request.responseText);
				//emailInsert(inputMail);
			} else {
				alert("Error: returned status code " + request.status + " " + request.statusText);
			}
        }
    }
    request.send();
}	
function pseudoChange(){
	let mail = document.getElementById('userEmail').innerHTML;
	//console.log(actualMail);
	const login =  document.getElementById('newPseudo').value;
	//console.log(inputMail);
	let request = new XMLHttpRequest();  
	request.onreadystatechange = function() {
		if(request.readyState == 4) {
			if(request.status == 200) {
				//removeElement('userEmail');
				let divEmail = document.getElementById('userLogin');
				console.log(divEmail);
				console.log('responseText = ' + request.responseText);
				console.log('response = ' + request.response);
				divEmail.innerHTML = request.responseText;
				console.log(request.responseText);
				//emailInsert(inputMail);
			} else {
				alert("Error: returned status code " + request.status + " " + request.statusText);
			}
		}
	}
	request.open("POST", "changePseudoProcess.php", true);    
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	request.send(`newLogin=${login}&email=${mail}`);
}