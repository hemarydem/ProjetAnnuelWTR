//this function work with an onclick 
// it display the enigma's trick
function enigmaTrick() {
     // this code cute two time the url to get what is in param in the url the [1] is here
     // to get the second element of the array
    let enigmaId = document.location.search.split('?')[1].split('=')[1];
    tricksBox = document.getElementById('tricksBox');
    console.log(tricksBox);
    let request = new XMLHttpRequest();  
    request.open("GET", "enigmaEnigmaTrickfunction.php?id=" + enigmaId, true); 
	request.onreadystatechange = function() {
		if(request.readyState == 4) {
			if(request.status == 200) {
                
                console.log(request.responseText);
                tricksBox.innerHTML = request.responseText;
			} else {
				alert("Error: returned status code " + request.status + " " + request.statusText);
			}
		}
	}
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send();
}