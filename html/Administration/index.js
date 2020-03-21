//to make empty the containeur for the next result
function NodeRemove() {
    const div = document.getElementById('mother');
    div.innerHTML = "";
}
//toot print the header of the html table
printResponsJson = () => {
    let table = document.createElement('table');
    table.id = 'tab';
    let div = document.getElementById('mother');
    div.appendChild(table);
    table = document.getElementById('tab');
    let tr =  document.createElement('tr');
    tr.id ='containeur';
    table.appendChild(tr);
    const arrayTitle = ['date de création', 'pseudo', 'Email', 'actif', 'activer', 'désactiver'];
    tr = document.getElementById('containeur');
    const arrayTh = [];
    for(let index = 0; index < arrayTitle.length; index++) {
        arrayTh[index] = document.createElement('th');
        arrayTh[index].innerHTML= arrayTitle[index];
        tr.appendChild(arrayTh[index]);
    }
}
//search in the data base user information by email
searchUserByMail = () => {
    let email = document.getElementById('searchByMail').value; // get admin input
	let request = new XMLHttpRequest();  
	request.onreadystatechange = function() {
		if(request.readyState == 4) {
			if(request.status == 200) {
                NodeRemove();
                let ObjJson = JSON.parse(request.responseText);
                printResponsJson();
                let table = document.getElementById('tab');
                let arraytr = [];
                let arrayTd = [];
                let indexTr = 0;
                let indexTd = 0;
                let indexInput = 0;
                let arryInput = [];
                let indice = 1;
                let input;
                ObjJson.forEach(element => {
                    
                    //creat a line
                    arraytr[indexTr] = document.createElement('tr');
                    arraytr[indexTr].id = indexTr;
                    table.appendChild(arraytr[indexTr]);
                    
                    //creat a column creation date
                    arrayTd[indexTd] = document.createElement('td');
                    arrayTd[indexTd].innerHTML = element['creationDate'];
                    document.getElementById(indexTr).appendChild(arrayTd[indexTd]);
                    indexTd++;
                    //creat a column login
                    arrayTd[indexTd] = document.createElement('td');
                    arrayTd[indexTd].innerHTML = element['login'];
                    document.getElementById(indexTr).appendChild(arrayTd[indexTd]);
                    indexTd++;
                    //creat a column email
                    arrayTd[indexTd] = document.createElement('td');
                    arrayTd[indexTd].innerHTML = element['email'];
                    document.getElementById(indexTr).appendChild(arrayTd[indexTd]);
                    indexTd++;
                    //creat a column working
                    arrayTd[indexTd] = document.createElement('td');
                    arrayTd[indexTd].innerHTML = element['working'];
                    arrayTd[indexTd].id = 'working' + indice.toString;
                    document.getElementById(indexTr).appendChild(arrayTd[indexTd]);
                    indexTd++;
                    //creat a column
                    arrayTd[indexTd] = document.createElement('td');
                    document.getElementById(indexTr).appendChild(arrayTd[indexTd]);
                    arryInput[indexInput] = document.createElement('a');
                    arryInput[indexInput].href = 'UserProfile.php?email=' + element['email'] ;
                    arryInput[indexInput].innerHTML = 'Profile';
                    document.getElementById(indexTr).appendChild(arryInput[indexInput]);
                    indexInput++;
                    indexTd++;
                    indice++;
                    indexTr++;//to creat a new line
                });
			} else {
				alert("Error: returned status code " + request.status + " " + request.statusText);
			}
		}
	}
	request.open("POST", "searchUserProcess.php", true);    
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	request.send(`emailKeyWord=${email}`);
}
//search in the data base user information by pseudo
searchUserByPseudo = () => {
    let pseudo = document.getElementById('searchByPseudo').value;
	let request = new XMLHttpRequest();  
	request.onreadystatechange = function() {
		if(request.readyState == 4) {
			if(request.status == 200) {
                NodeRemove();
                let ObjJson = JSON.parse(request.responseText);
                printResponsJson();
                let table = document.getElementById('tab');
                let arraytr = [];
                let arrayTd = [];
                let indexTr = 0;
                let indexTd = 0;
                let indexInput = 0;
                let arryInput = [];
                let indice = 1;
                let input;
                ObjJson.forEach(element => {
                    
                    //creat a line
                    arraytr[indexTr] = document.createElement('tr');
                    arraytr[indexTr].id = indexTr;
                    table.appendChild(arraytr[indexTr]);
                    
                    //creat a column creation date
                    arrayTd[indexTd] = document.createElement('td');
                    arrayTd[indexTd].innerHTML = element['creationDate'];
                    document.getElementById(indexTr).appendChild(arrayTd[indexTd]);
                    indexTd++;
                    //creat a column login
                    arrayTd[indexTd] = document.createElement('td');
                    arrayTd[indexTd].innerHTML = element['login'];
                    document.getElementById(indexTr).appendChild(arrayTd[indexTd]);
                    indexTd++;
                    //creat a column email
                    arrayTd[indexTd] = document.createElement('td');
                    arrayTd[indexTd].innerHTML = element['email'];
                    document.getElementById(indexTr).appendChild(arrayTd[indexTd]);
                    indexTd++;
                    //creat a column working
                    arrayTd[indexTd] = document.createElement('td');
                    arrayTd[indexTd].innerHTML = element['working'];
                    arrayTd[indexTd].id = 'working' + indice.toString;
                    document.getElementById(indexTr).appendChild(arrayTd[indexTd]);
                    indexTd++;
                    //creat a column
                    arrayTd[indexTd] = document.createElement('td');
                    document.getElementById(indexTr).appendChild(arrayTd[indexTd]);
                    arryInput[indexInput] = document.createElement('a');
                    arryInput[indexInput].href = 'UserProfile.php?email=' + element['email'] ;
                    arryInput[indexInput].innerHTML = 'Profile';
                    document.getElementById(indexTr).appendChild(arryInput[indexInput]);
                    indexInput++;
                    indexTd++;
                    indice++;
                    indexTr++;//to creat a new line
                });
			} else {
				alert("Error: returned status code " + request.status + " " + request.statusText);
			}
		}
	}
	request.open("POST", "searchUserProcess.php", true);    
	request.setrequestuestHeader("Content-Type", "application/x-www-form-urlencoded");
	request.send(`pseudoKeyWord=${pseudo}`);
}
const but = document.getElementById('searchByMail');
but.addEventListener('input',searchUserByMail);
