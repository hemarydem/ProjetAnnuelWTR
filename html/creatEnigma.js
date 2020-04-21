
let nbFalseAnswers = 1;
function addInput(){

  const container = document.getElementById('falseAnswersContainer');
  if(!container){
    alert('Pas de conteneur');
    return;
  }

  const input = document.createElement('input');
  input.className = 'falseAnswer';
  input.placeholder = 'Fausse réponse';

  const suppButton = document.createElement('button');
  suppButton.innerHTML = 'X';
  suppButton.id = 'suppFalseAnswerButton' + nbFalseAnswers;
  const nb = nbFalseAnswers;
  suppButton.onclick = function(){suppFalseAnswer(nb)};

  container.appendChild(input);
  container.appendChild(suppButton);
  nbFalseAnswers++;
}

function suppFalseAnswer(nb){
  const form = document.forms['creatEnigmaForm'];
  const container = document.getElementById('falseAnswersContainer');
  const input = form['falseAnswer'+ nb];
  const button = document.getElementById('suppFalseAnswerButton'+nb);
  if(!container || !input || !button){
    alert('Erreur: éléments manquants');
    return;
  }

  container.removeChild(input);
  container.removeChild(button);

}

function check(){
  const form = document.forms['creatEnigmaForm'];
  const title = form['title'];
  const description = form['description'];
  const question = form['question'];
  const trueAnswer = form['trueAnswer'];
  const level = form['level'];
  const trick = form['trick'];

  if(!title || !description || !question || !trueAnswer || !level || !trick){
    alert('Champs manquant');
    return false;
  }




  const falseAnswers = document.getElementsByClassName('falseAnswer');
  let strFalseAnswers = '';
  for(let i = 0; i < falseAnswers.length; i++){
    const length = falseAnswers[i].value.length;
    if( length < 2 || length > 60 || falseAnswers[i].value.trim().toUpperCase() == trueAnswer.value.trim().toUpperCase()){
      falseAnswers[i].style.border = 'solid 2px red';
      return false;
    }
    strFalseAnswers += falseAnswers[i].value + '|';
  }
  strFalseAnswers = strFalseAnswers.substring(0,strFalseAnswers.length-1);

  if( !checkLength(title, 60, 'titleContainer') ||
      !checkLength(description, 60, 'descriptionContainer') ||
      !checkLength(question, 60, 'questionContainer') ||
      !checkLength(trueAnswer, 60, 'trueAnswerContainer')
    ){
    return false;
  }
  
  const falseAnswer = document.getElementById('falseAnswer0');
  falseAnswer.value = strFalseAnswers;
  console.log(falseAnswer.value);
  return true;

}

function  checkLength(input, maxLength, idContainer){
  const container = document.getElementById(idContainer);
  if(!container)return false;

  const msg = document.getElementsByClassName(input.id + 'Msg');
  for(let i = 0; i < msg.length; i++){
    container.removeChild(msg[i]);
  }

  const length = input.value.trim().length;
  if(length < 2 || length > maxLength ){
    input.style.border = 'solid 2px red';

    const msg = document.createElement('p');
    msg.className = input.id + 'Msg';
    msg.innerHTML = length < 2?'Trop court':'Trop long';
    container.appendChild(msg);
    return false;
  }
  input.style.border = '';
  return true;


}




//
