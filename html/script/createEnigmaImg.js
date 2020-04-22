
const isClickable =  [false, false, false, false, false, false,false,false];

function selectDiv(id){
    const div = document.getElementById(id);
    
    if(isClickable[id] == false){
        isClickable[id] = true;
        div.style.border = 'solid 2px green';
    }else{
        isClickable[id] = false;
        div.style.border = '';
    }
}

function chekIs() {
   let answer = '';
    for(let i = 0; i < 8; i++){
        if(isClickable[i] == true ) {
            answer += isClickable[i];
        }
    }
    let inputAnswers = document.getElementById('strAnswers');
    inputAnswers.value = answer;
}

const form = document.forms['creatEnigmaForm'];
const title = form['title'];
const description = form['description'];
const question = form['question'];
title.addEventListener('input', check);
description.addEventListener('input', check);
question.addEventListener('input', check);

function check(){
    const form = document.forms['creatEnigmaForm'];
    const title = form['title'];
    const description = form['description'];
    const question = form['question'];
    const level = form['level'];
    const trick = form['trick'];
    const strAnswers = form['strAnswers'];
  
    if(!title || !description || !question || !level || !trick || !strAnswers){
      alert('Champs manquant');
      return false;
    }
  
    if( !checkLength(title, 60, 'titleContainer') ||
        !checkLength(description, 60, 'descriptionContainer') ||
        !checkLength(question, 60, 'questionContainer')
      ){
      return false;
    }
    return true;
  
  }


  function  checkLength(input, maxLength, idContainer){
    const container = document.getElementById(idContainer);
    
    if(!container)return false;
  
    const msg = document.getElementsByClassName(input.name + 'Msg');
    for(let i = 0; i < msg.length; i++){
        container.removeChild(msg[i]);
    }
  
    const length = input.value.trim().length;
    if(length < 2 || length > maxLength ){
      input.style.border = 'solid 2px red';
  
      const msg = document.createElement('p');
      msg.className = input.name + 'Msg';
      msg.innerHTML = length < 2?'Trop court':'Trop long';
      container.appendChild(msg);
      return false;
    }
    input.style.border = '';
    return true;
  
  
  }