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
    falseAnswerNb++;
}     

function suppAnswer(idInput, idButton) {
       
    let elementTosupp = document.getElementById(idInput);
    let elementTosupp2 = document.getElementById(idButton);
    container.removeChild(elementTosupp);
    container.removeChild(elementTosupp2);
}

function messageError(idContaineur, strMessag) {
    let container = document.getElementById(idContaineur);
    let messagesArray = container.getElementsByTagName('p');
    container.appendChild(messagesArray);
    let message = document.createElement('p');
    message.innerHTML = strMessag;
    container.appendChild(message);
}


function checkStringLength( shortLimit, longerLimit, idInput) {
    const input = document.getElementById(idInput);
    const string = input.value;
    
    if (typeof string !== 'undefined' && string !== '') {
        //too short
        if(string.length < shortLimit) {
            input.style.border='2px solid #FF0000';//red
            messageError(idInput + 'Container', 'Trop court');
            
            return false;
        //too long
        } else if (string.length > longerLimit) {
            input.style.border="2px solid #ff7979";//red
            return false;
        }
        // ok
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
    if(checkStringLength(1,60,'title') && checkStringLength(1,60,'question') && checkStringLength(1,60,'trueAnswer')){}



    let alseAnswersArray = document.getElementsByTagName('input');

    
}



function addEngima() {
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
