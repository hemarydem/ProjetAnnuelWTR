
printValueSlider();

//print the number selected
const slider = document.getElementById('slideTopPlayers');
requestBestPlayers(slider.value);
slider.oninput = function printValueSlider(){
  const nbTop = document.getElementById('nbTop');
  nbTop.innerHTML = slider.value;
  requestBestPlayers(slider.value);
};
function printValueSlider(){
  document.getElementById('nbTop').innerHTML = document.getElementById('slideTopPlayers').value;
}


function requestBestPlayers(nb) {
  document.getElementById('bestPlayersTable').innerHTML = "";
  const request = new XMLHttpRequest();
  request.open('GET', 'tracking/topPlayers.php?nbTop=' + nb);
  request.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      let xml = this.response;
      browseXML(xml);
    }
  }
  request.send();
}


function browseXML(xml){
  const parser = new DOMParser();
  let xmlDoc = parser.parseFromString(xml,"text/xml");
  let playersXML = xmlDoc.getElementsByTagName("players");
  if(playersXML.length > 0){

    let players = playersXML[0].childNodes;
    for(let i = 0; i < players.length; i++){
      let login= players[i].childNodes[0].innerHTML;
      let points = players[i].childNodes[1].innerHTML;
      createLine(login, points);

    }
  }
}


function createLine(login, points){
  const table = document.getElementById('bestPlayersTable');
  const line = document.createElement('tr');

  const columnLogin = document.createElement('td');
  columnLogin.innerHTML = login;
  line.appendChild(columnLogin);

  const columnPoints = document.createElement('td');
  columnPoints.innerHTML = points;
  line.appendChild(columnPoints);

  table.appendChild(line);

}
