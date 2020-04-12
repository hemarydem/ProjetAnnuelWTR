//to display all the reason alreayd existed
let displayTrigger = 0;
if(displayTrigger == 0) {
    displayReason();
    displayTrigger++;
}

//listen the input each tipe somthing is type
const reasonInput = document.getElementById('newReason');
reasonInput.addEventListener('input',checkInputReason());

//for the id of tr to creat under eache other.
let tr = 0;

//Creat the head of the table with in param an array of titles
function printheadTable (array) {
    console.log('printtable ok');
    
    // création table
    let table = document.createElement('table');
    table.id = 'tab';
    //grab an element already on the page who will be the containeur of all elements
    let div = document.getElementById('mother');
    div.innerHTML = '';
    div.appendChild(table);
    //creation line
    table = document.getElementById('tab');
    let tr =  document.createElement('tr');
    tr.id ='containeur';
    table.appendChild(tr);

    const arrayTitle = array;
    tr = document.getElementById('containeur');
    const arrayTh = [];
    for(let index = 0; index < arrayTitle.length; index++) {
        arrayTh[index] = document.createElement('th');
        arrayTh[index].innerHTML= arrayTitle[index];
        tr.appendChild(arrayTh[index]);
    }
}

// add a line to the table of the reason list
//this fucntion is linkt to the function printheadTable 
// it will try to grab the tab create by printHeadTable
function addlineRepport(array, numtr, strPath) {
    console.log('addTable report ok');

    const arrayTd = [];
    let indexTd = 0;
    let indexTr = numtr;
    let table = document.getElementById('tab');

     //creat a line
     newTR = document.createElement('tr');
     newTR.id = indexTr;
     table.appendChild(newTR);

    //each loop create a column
    console.log(array);
     for(let tabColum = 0; tabColum < array.length ; tabColum++) {

            arrayTd[indexTd] = document.createElement('td');
            arrayTd[indexTd].innerHTML = (array[tabColum]);
            let elemetDaddy = document.getElementById(indexTr);
            elemetDaddy.appendChild(arrayTd[indexTd]);
            indexTd++;
     }
}

// send http request to reportCreatReasonProcess.php
//wiil get back string json
// transform it in object json and displys it by function upper
function displayReason() {
    let request = new XMLHttpRequest();
    request.open("GET", "reportCreatReasonProcess.php?option=" + 2, true);
    request.onreadystatechange = function() {
        if(request.readyState == 4) {
            if(request.status == 200) {
                let ObjJson = JSON.parse(request.responseText);
                let trigger = 0;
                
                ObjJson.forEach(element => {
                    //here it's store data of the line
                    let array = [element['idReason'],element['reason']];
                    
                    //here set the titles of your columns
                    let title =['id', 'reason'];
                    
                    //only nead to creat one time printheaTable
                    if(trigger == 0){
                        printheadTable (title);
                        trigger++;
                    }
                    addlineRepport(array, tr);
                    tr++;
                });
            } else {
                alert("Error: returned status code " + request.status + " " + request.statusText);
            }
        }
    }
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send();
}

//param 1 the string, shorter limit of the string, longer limit of the string
//return a boolean
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

//launch http request to creat the new reason
function addReason(strReason) {
    let request = new XMLHttpRequest();
    request.open("POST", "reportCreatReasonProcess.php?option=" + 2, true);
    request.onreadystatechange = function() {
        if(request.readyState == 4) {
            if(request.status == 200) {
                displayReason();
            } else {
                alert("Error: returned status code " + request.status + " " + request.statusText);
            }
        }
    }
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(`reason=${strReason}&option=${1}`);
}

function checkInputReason(){
    if(checkStringLength(reasonInput,1,100))addReason(reasonInput.value);
}

