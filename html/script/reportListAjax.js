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

// add a line to the table of the creation level
//this fucntion is linkt to the function upper 
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
        //don't need to display topic id and reporter id
        if(tabColum <= 3) {

            arrayTd[indexTd] = document.createElement('td');
            arrayTd[indexTd].innerHTML = (array[tabColum]);
            let elemetDaddy = document.getElementById(indexTr);
            elemetDaddy.appendChild(arrayTd[indexTd]);
            indexTd++;

        } else {
            //creat the link for handling the report
            let arryInput = [];
            indexInput = 0;
            arrayTd[indexTd] = document.createElement('td');
            document.getElementById(indexTr).appendChild(arrayTd[indexTd]);
            arryInput[indexInput] = document.createElement('a');
            arryInput[indexInput].href = strPath + array[array.length - 2] + '&reporter=' + array[array.length - 1];//'reporthandling.php?topic=' + array[array.length - 2] + '&reporter=' + array[array.length - 1];
            arryInput[indexInput].innerHTML = 'Handling';
            document.getElementById(indexTr).appendChild(arryInput[indexInput]);
            tabColum+=2;
        }
     }
}

//launch http request to creat the level
function searchReportTopic() {
    let request = new XMLHttpRequest();
    request.open("GET", "reportListAjax.php?option=" + 1, true);
    request.onreadystatechange = function() {
        if(request.readyState == 4) {
            if(request.status == 200) {
                let ObjJson = JSON.parse(request.responseText);
                let trigger = 0;
                
                ObjJson.forEach(element => {
                    //here it's store data of the line
                    let array = [element['title'],element['login'] ,element['reason'], element['reportDate'], element['topic'], element['reporter']];
                    
                    //here set the titles of your columns
                    let title =['topic', 'reporter', 'reason', 'reportDate'];
                    
                    //only nead to creat one time printheaTable
                    if(trigger == 0){
                        printheadTable (title);
                        trigger++;
                    }
                    addlineRepport(array, tr, 'reporthandling.php?topic=');
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

 function searchReportEnigma() {
     
    let request = new XMLHttpRequest();
    //option is the data to active the well part on the php file
    request.open("GET", "reportListAjax.php?option=" + 2, true);
    request.onreadystatechange = function() {
        if(request.readyState == 4) {
            if(request.status == 200) {
                let ObjJson = JSON.parse(request.responseText);
                let trigger = 0;
                console.log(ObjJson);
                
                ObjJson.forEach(element => {
                    //here it's store data of the line
                    let array = [element['title'],element['login'] ,element['reason'], element['reportDate'], element['enigma'], element['reporter']];
                    
                    //here set the titles of your columns
                    let title =['enigma', 'reporter', 'reason', 'reportDate'];
                    
                    //only nead to creat one time printheaTable
                    if(trigger == 0){
                        printheadTable (title);
                        trigger++;
                    }
                    addlineRepport(array, tr, 'reporthandlingEnigma.php?enigma=');
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

 function searchReportMessage() {
     
    let request = new XMLHttpRequest();
    //option is the data to active the well part on the php file
    request.open("GET", "reportListAjax.php?option=" + 3, true);
    request.onreadystatechange = function() {
        if(request.readyState == 4) {
            if(request.status == 200) {
                let ObjJson = JSON.parse(request.responseText);
                let trigger = 0;
                console.log(ObjJson);
                
                ObjJson.forEach(element => {
                    //here it's store data of the line
                    let array = [element['content'],element['login'] ,element['reason'], element['reportDate'], element['message'], element['reporter']];
                    
                    //here set the titles of your columns
                    let title =['content', 'reporter', 'reason', 'reportDate'];
                    
                    //only nead to creat one time printheaTable
                    if(trigger == 0){
                        printheadTable (title);
                        trigger++;
                    }
                    addlineRepport(array, tr, 'reporthandlingmessage.php?enigma=');
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

