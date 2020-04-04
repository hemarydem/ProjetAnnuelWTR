const searchInput = document.getElementById('wantedLevel');
searchInput.addEventListener('input',searchLevelByName);

const searchInputThreshold = document.getElementById('wantedThreshold');
searchInputThreshold.addEventListener('input',searchLevelBythreshold);

function printResponsJson () {
    let table = document.createElement('table');
    table.id = 'tab';
    let div = document.getElementById('mother');
    div.innerHTML = "";
    div.appendChild(table);
    table = document.getElementById('tab');
    let tr =  document.createElement('tr');
    tr.id ='containeur';
    table.appendChild(tr);
    const arrayTitle = ['Nom', 'seuil'];
    tr = document.getElementById('containeur');
    const arrayTh = [];
    for(let index = 0; index < arrayTitle.length; index++) {
        arrayTh[index] = document.createElement('th');
        arrayTh[index].innerHTML= arrayTitle[index];
        tr.appendChild(arrayTh[index]);
    }
}

function searchLevelByName() {
    let wantedLevel = document.getElementById('wantedLevel').value;
    let request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if(request.readyState == 4) {
            if(request.status == 200) {
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
                    arrayTd[indexTd].innerHTML = element['name'];
                    document.getElementById(indexTr).appendChild(arrayTd[indexTd]);
                    indexTd++;
                    //creat a column login
                    arrayTd[indexTd] = document.createElement('td');
                    arrayTd[indexTd].innerHTML = element['threshold'];
                    document.getElementById(indexTr).appendChild(arrayTd[indexTd]);
                    indexTd++;
                    
                    //creat a column
                    arrayTd[indexTd] = document.createElement('td');
                    document.getElementById(indexTr).appendChild(arrayTd[indexTd]);
                    arryInput[indexInput] = document.createElement('a');
                    arryInput[indexInput].href = 'UserProfile.php?email=' + element['name'] ;
                    arryInput[indexInput].innerHTML = 'Niveau';
                    document.getElementById(indexTr).appendChild(arryInput[indexInput]);
                    indexInput++;
                    indexTd++;
                    indice++;
                    indexTr++;//to creat a new line
                });
            }else {
				alert("Error: returned status code " + request.status + " " + request.statusText);
			}

        }
    }
    request.open("POST", "levelAdminSearch.php", true);    
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	request.send(`levelName=${wantedLevel}&option=${0}`);
}
function searchLevelBythreshold() {
    let wantedThreshold = document.getElementById('wantedThreshold').value;
    let request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if(request.readyState == 4) {
            if(request.status == 200) {
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
                    arrayTd[indexTd].innerHTML = element['name'];
                    document.getElementById(indexTr).appendChild(arrayTd[indexTd]);
                    indexTd++;
                    //creat a column login
                    arrayTd[indexTd] = document.createElement('td');
                    arrayTd[indexTd].innerHTML = element['threshold'];
                    document.getElementById(indexTr).appendChild(arrayTd[indexTd]);
                    indexTd++;
                    
                    //creat a column
                    arrayTd[indexTd] = document.createElement('td');
                    document.getElementById(indexTr).appendChild(arrayTd[indexTd]);
                    arryInput[indexInput] = document.createElement('a');
                    arryInput[indexInput].href = 'UserProfile.php?email=' + element['name'] ;
                    arryInput[indexInput].innerHTML = 'Niveau';
                    document.getElementById(indexTr).appendChild(arryInput[indexInput]);
                    indexInput++;
                    indexTd++;
                    indice++;
                    indexTr++;//to creat a new line
                });
            }else {
				alert("Error: returned status code " + request.status + " " + request.statusText);
			}

        }
    }
    request.open("POST", "levelAdminSearch.php", true);    
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	request.send(`threshold=${wantedThreshold}&option=${1}`);
}
function searchLevelByBoth(){
    let wantedThreshold = document.getElementById('wantedThresholdB').value;
    let wantedLevel = document.getElementById('wantedLevelB').value;
    let request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if(request.readyState == 4) {
            if(request.status == 200) {
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
                    arrayTd[indexTd].innerHTML = element['name'];
                    document.getElementById(indexTr).appendChild(arrayTd[indexTd]);
                    indexTd++;
                    //creat a column login
                    arrayTd[indexTd] = document.createElement('td');
                    arrayTd[indexTd].innerHTML = element['threshold'];
                    document.getElementById(indexTr).appendChild(arrayTd[indexTd]);
                    indexTd++;
                    
                    //creat a column
                    arrayTd[indexTd] = document.createElement('td');
                    document.getElementById(indexTr).appendChild(arrayTd[indexTd]);
                    arryInput[indexInput] = document.createElement('a');
                    arryInput[indexInput].href = 'UserProfile.php?email=' + element['name'] ;
                    arryInput[indexInput].innerHTML = 'Niveau';
                    document.getElementById(indexTr).appendChild(arryInput[indexInput]);
                    indexInput++;
                    indexTd++;
                    indice++;
                    indexTr++;//to creat a new line
                });
            }else {
				alert("Error: returned status code " + request.status + " " + request.statusText);
			}

        }
    }
    request.open("POST", "levelAdminSearch.php", true);    
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	request.send(`levelName=${wantedLevel}&threshold=${wantedThreshold}&option=${3}`);
}