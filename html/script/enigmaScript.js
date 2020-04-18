//this function work with an onclick 
// it display the enigma's trick
function enigmaTrick() {
     // this code cute two time the url to get what is in param in the url the [1] is here
     // to get the second element of the array
    let enigmaId = document.location.search.split('?')[1].split('=')[1];
    tricksBox = document.getElementById('tricksBox');
    let request = new XMLHttpRequest();  
    request.open("GET", "enigmaEnigmaTrickfunction.php?id=" + enigmaId, true); 
	request.onreadystatechange = function() {
		if(request.readyState == 4) {
			if(request.status == 200) {
                tricksBox.innerHTML = request.responseText;
			} else {
				alert("Error: returned status code " + request.status + " " + request.statusText);
			}
		}
	}
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send();
}

function getAnwser(idDiv) {
    let enigmaId = document.location.search.split('?')[1].split('=')[1];
    let answer = document.getElementById(idDiv).innerHTML;
    let timerMinutes = document.getElementById('minutes').value;
    let timerSeconds = document.getElementById('seconds').value;
    let request = new XMLHttpRequest();  
    request.open("POST", "enigmagetAnwserfunction.php", true); 
    request.onreadystatechange = function() {
        if(request.readyState == 4) {
            if(request.status == 200) {
                ValidatorAnswer(request.responseText, idDiv,timerMinutes,timerSeconds);
            } else {
            alert("Error: returned status code " + request.status + " " + request.statusText);
            }
        }
    }
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(`answer=${answer}&id=${enigmaId}`);
}

/////// function synchrone//////
function ValidatorAnswer(resulstAnsw, AnswerElementId,minutes,seconds) { // en hommag à bouba
    let answerDive = document.getElementById(AnswerElementId);
    if(minutes.value > 0 && seconds.value > 0){
        if(resulstAnsw == '1'){
            answerDive.style.backgroundColor = "green";
        } else {
            answerDive.style.backgroundColor = "red";
        }
    }else{
        answerDive.style.backgroundColor = "red";
        alert("trop tard le timer est terminé")
        ////function echec
        ///redirection page echec
    }
}