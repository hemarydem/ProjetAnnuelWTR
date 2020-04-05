printResponsJson ();
//get information from both inputs
const LevelName = document.getElementById('name');
LevelName.addEventListener('input',checkFormLevel);

const Levelthreshold = document.getElementById('threshold');
Levelthreshold.addEventListener('input',checkFormLevel);

function printResponsJson () {
    let table = document.createElement('table');
    table.id = 'tab';
    let div = document.getElementById('createdToDay');
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

function addline( name, threshold) {
    let newTR;
    const arrayTd = [];
    let indexTd = 0;
    let indexTr = 1;
    let table = document.getElementById('tab');

     //creat a line
     newTR = document.createElement('tr');
     newTR.id = indexTr;
     table.appendChild(newTR);

     //creat a column creation date
     arrayTd[indexTd] = document.createElement('td');
     arrayTd[indexTd].innerHTML = name;
     document.getElementById(indexTr).appendChild(arrayTd[indexTd]);
     indexTd++;

     //creat a column login
     arrayTd[indexTd] = document.createElement('td');
     arrayTd[indexTd].innerHTML = threshold;
     document.getElementById(indexTr).appendChild(arrayTd[indexTd]);
}
function checkStringLength(string, shortLimit, longerLimit, InputElement) {

    if(string.length < shortLimit) {
        document.getElementById('shorter').style.background='rgb(177, 15, 15)';
        InputElement.style.border="2px solid #ff7979";
        return false;
    } else if (string.value.length > longerLimit) {
        document.getElementById('longer').style.background='rgb(177, 15, 15)';
        InputElement.style.border="2px solid #ff7979";
        return false;
    }
    document.getElementById('shorter').style.background='177, 15, 15';
    document.getElementById('longer').style.background='177, 15, 15';
    return true;
}
function checkFormLevel(){
    let checkIsOK = true;
    const inputLevelName = document.getElementById('name').value.trim();
    const inputLevelthreshold = document.getElementById('threshold').value.trim();
    checkStringLength(inputLevelName, 2, 60, )

}

function creationLevel() {
let request = new XMLHttpRequest();  
request.onreadystatechange = function() {
    if(request.readyState == 4) {
        if(request.status == 200) {
            addline(ObjJson[0]['name'], ObjJson[0]['threshold']);  
        } else {
            alert("Error: returned status code " + request.status + " " + request.statusText);
        }
    }
}
request.open("POST", "leveCreatProcess.php", true); 
request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
request.send(`name=${LevelName}&threshold=${Levelthreshold}`);
}