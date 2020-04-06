printheadTable ();
//get information from both inputs
const LevelName = document.getElementById('name');
//LevelName.addEventListener('input',checkFormLevel);

const Levelthreshold = document.getElementById('threshold');
//Levelthreshold.addEventListener('input',checkFormLevel);

let circleNume = document.getElementById('isNumber'); 
let CircleShort = document.getElementById('shorter');
let circleLonger = document.getElementById('longer');

//for the id of tr to creat under eache other.
let tr = 0;

//Creat the head of the table
function printheadTable () {
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
// add a line to the table of the creation level
function addline( name, threshold, numtr) {
    let newTR;
    const arrayTd = [];
    let indexTd = 0;
    let indexTr = numtr;
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
     return indexTr;
}
// check the length of th string make circle green when its good. returne a boolean
function checkStringLength(string, shortLimit, longerLimit) {
    if (typeof string !== 'undefined' && string !== '') {
        //too short
        if(string.length < shortLimit) {
            CircleShort.style.backgroundColor='#FF0000';//red
            circleLonger.style.background='#32CD32';//green
            return false;
        //too long
        } else if (string.length > longerLimit) {
            CircleShort.style.background='#32CD32';//green
            circleLonger.style.backgroundColor='#FF0000';//red
            return false;
        }
        // ok
        CircleShort.style.background='#32CD32';//green
        circleLonger.style.background='#32CD32';//green
        return true;
    } else {
        // the input is empty
        CircleShort.style.background='#FF0000';//red
        circleLonger.style.background='#FF0000';//red
        return false;
    }
}
// check if it's a num returne a boolean
function isNum(num) {
    if (typeof num !== 'undefined' && num !== '') {
        for (let i = 0; i < num.length; i++) {
            if(num.charCodeAt(i) >= 48 && num.charCodeAt(i) <= 57) {
                circleNume.style.background ="#32CD32";//green
            } else {
                // the char is not a number
                circleNume.style.background ="#FF0000";//red
                return false;
            }
        }
        // ok
        circleNume.style.background ="#32CD32";//green
        return true;
    } else {
        // the input is empty
        circleNume.style.background ="#FF0000";//red
        return false;
    }
}
//launch http request to creat the level
function creationLevel(strName, strThreshold) {
    let request = new XMLHttpRequest();
    request.open("POST", "levelCreatProcess.php", true);
    request.onreadystatechange = function() {
        if(request.readyState == 4) {
            if(request.status == 200) {
                let ObjJson = JSON.parse(request.responseText);
                addline(ObjJson[0]['name'], ObjJson[0]['threshold'], tr);
                tr++;
                console.log(tr);
                
            } else {
                alert("Error: returned status code " + request.status + " " + request.statusText);
            }
        }
    }
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(`name=${strName}&threshold=${strThreshold}`);
}

// if all functions return true check form level call the ajax function
function checkFormLevel(){
    const inputLevelName = document.getElementById('name').value.trim();
    const inputLevelthreshold = document.getElementById('threshold').value.trim();
    let isOK = true;
    if(!checkStringLength(inputLevelName, 2, 60)) isOK = false;
    if(!isNum(inputLevelthreshold)) isOK = false;
    if(isOK) creationLevel(inputLevelName,inputLevelthreshold);
}