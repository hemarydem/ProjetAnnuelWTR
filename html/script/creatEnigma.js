let container = document.getElementById('falseAnswersContainer');
let falseAnswerNb = 1;

function addinput(){
    let newInput = document.createElement('input');
    newInput.placeholder="entrez votre mauvaise réponse";
    newInput.id = "falseAnswer"+falseAnswerNb;
    container.appendChild(newInput);
    let suppbutton = document.createElement('button');
    suppbutton.id= 'suppbutton' + falseAnswerNb;
    suppbutton.innerHTML = 'Supp';
    suppbutton.onclick = function(){ suppAnswer( newInput.id, suppbutton.id ) };
    container.appendChild(suppbutton);
    let tank = document.getElementById('custId');
    tank.value = parseInt(tank.value)++;
    falseAnswerNb++;
}     

function suppAnswer(idInput, idButton) {
       
    let elementTosupp = document.getElementById(idInput);
    let elementTosupp2 = document.getElementById(idButton);
    container.removeChild(elementTosupp);
    container.removeChild(elementTosupp2);
}

function messageError(idContaineur, strMessag, strIdmessage) {
    let container = document.getElementById(idContaineur);
    let lastmessage = document.getElementById(strIdmessage);
    if( lastmessage ) container.removeChild(lastmessage);
    let message = document.createElement('p');
    message.id = strIdmessage;
    message.innerHTML = strMessag;
    container.appendChild(message);
}

function supp(iDcontainer,strIdmessage){
    let container = document.getElementById(iDcontainer);
    let lastmessage = document.getElementById(strIdmessage);
    container.removeChild(lastmessage);
};


function checkStringLength( shortLimit, longerLimit, idInput, idMsg, idcontainer) {
    const input = document.getElementById(idInput);
    const string = input.value;
    
    if (typeof string !== 'undefined' && string !== '') {
        //too short
        if(string.length < shortLimit) {
            input.style.border='2px solid #FF0000';//red
            messageError(idInput + 'Container', 'Trop court', idMsg );
            
            return false;
        //too long
        } else if (string.length > longerLimit) {
            input.style.border="2px solid #ff7979";//red
            messageError(idInput + 'Container', 'Trop long', idMsg);
            return false;
        }
        // ok
        supp(idcontainer,idMsg);
        input.style.border='2px solid #32CD32';//green
       
        return true;
    } else {
        // the input is empty
        input.style.border='2px solid #FF0000';//red
        return false;
    }
}

function check(){
    let trigger = true;
    if(checkStringLength(1,60,'title','titleMessage','titleContainer') && checkStringLength(1,60,'question','questionMessage','questionContainer') && checkStringLength(1,60,'trueAnswer','trueAnswerMessage', 'trueAnswerContainer')){}


    
}



function addEngima() {
    let request = new XMLHttpRequest();
    let allfalseAnswer = [];
    let tankflaseAnswer = document.getElementById('custId').value;
    let title = document.getElementById('title');
    let description= document.getElementById('description');
    let question = document.getElementById('question');
    let trueAnswer = document.getElementById('trueAnswer');
    let level = document.getElementById('level');
    if( tankflaseAnswer > 1) {
        for (let i = 2; i < tankflaseAnswer; i++) {
            allfalseAnswer [i] = document.getElementById(i);
        }
    }
    
    request.open("POST", ".php", true);
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
                    addlineRepport(array, tr, 'reportCreatReasonProcess.php');
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
