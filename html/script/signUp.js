

// Récuperer les inputs et le msg du html
let inputs = document.forms['signUp'];
let msg = document.getElementById('msg');

//Pseudo
inputs['pseudo'].addEventListener('change', function(){
  this.value =  this.value.trim();

  if(this.value.length < 5){
    msg.innerHTML = 'Pseudo trop court';
    this.style.border="2px solid #ff7979";
  }
  else if (this.value.length > 16) {
    msg.innerHTML = 'Pseudo trop long';
    this.style.border="2px solid #ff7979";
  }
  else {
    msg.innerHTML = '';
    this.style.border="none";
  }
});

//Mot de passe
inputs['password'].addEventListener('change', function(){

  //trim
  this.value =  this.value.trim();


  //  Entre 5 et 20 caractères
  //	Au moins:
  //	1 Majuscule
  //	1 chiffre
  //	1 caractère spécial

  let checkLength = '';
  let checkCapitalLetter = false;
  let checkDigit = false;
  let checkSpecialCars = false;
  let specialCars = "!\"#$%&'()*+,-./:;<=>?@[\\]^_`{|}~";


  //Longueur du mot de passe
  if(this.value.length < 5){
    checkLength = 'short';
  }
  else if (this.value.length > 20) {
    checkLength = 'long';
  }

  //Majuscule, chiffre et caractère spécial
  for(let i = 0; i < this.value.length; i++){

    //Majuscule
    if(this.value.charCodeAt(i) >= 65 && this.value.charCodeAt(i) <= 90){
      checkCapitalLetter = true;
    }

    //Chiffre
    if(this.value.charCodeAt(i) >= 48 && this.value.charCodeAt(i) <= 57){

      checkDigit = true;
    }
  }

  //Caractère spécial
  for (let i = 0; i < specialCars.length; i++) {
    if( this.value.indexOf(specialCars[i]) != -1){
      checkSpecialCars = true;
    }
  }

  //bord rouge
  this.style.border = "2px solid #ff7979";

  if(checkLength === 'short')
    msg.innerHTML = 'Mot de passe trop court';
  else if (checkLength === 'long')
    msg.innerHTML = 'Mot de passe trop long';
  else if(checkCapitalLetter === false)
    msg.innerHTML = 'Le mot de passe doit contenir au moins une majuscule';
  else if (checkDigit === false)
    msg.innerHTML = 'Le mot de passe doit contenir au moins un chiffre';
  else if( checkSpecialCars === false)
    msg.innerHTML = 'Le mot de passe doit contenir au moins un caractère spécial';
  else{
    msg.innerHTML = '';
    this.style.border = "0px";
  }



});

//Confimation du mot de passe
inputs['password2'].addEventListener('input', function(){

  if(this.value !== document.forms['signUp']['password'].value){
    msg.innerHTML = 'Les deux mots de passe sont différents';
    this.style.border="2px solid #ff7979";
  }else {
    msg.innerHTML = '';
    this.style.border="none";
  }
});

//interdire le click droit
document.oncontextmenu = new Function("return false");
