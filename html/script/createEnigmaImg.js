
const isClickable =  [false, false, false, false, false, false,false,false];
let jk = 0;
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

