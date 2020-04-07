
const selectLevels = document.getElementById('levels');
selectLevels.addEventListener('change',displayBestEnigmas, false);
displayBestEnigmas();

function displayBestEnigmas(){
  const list = document.getElementById('levels');
  const listTab = list.options;
  const level = listTab[list.selectedIndex].innerHTML;
  let idLevel = parseInt( list.value );
  const tableBody = document.getElementById('bestEnigmasTable');
  tableBody.innerHTML = "";

  requestBestLevels(idLevel);
}


function requestBestLevels(idLevel){
  const request = new XMLHttpRequest();
  request.open('POST', 'tracking/bestEnigmas.php');
  request.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      let xml = this.responseText;
      browseXMLEnigmas(xml);
    }
  }
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  request.send(`idLevel=${idLevel}`);
}


function browseXMLEnigmas(xml){
  const parser = new DOMParser();
  let xmlDoc = parser.parseFromString(xml,"text/xml");
  let enigmasXML = xmlDoc.getElementsByTagName("enigmas");
  if(enigmasXML.length > 0){

    let enigmas = enigmasXML[0].childNodes;
    for(let i = 0; i < enigmas.length; i++){
      let title = enigmas[i].childNodes[0].innerHTML;
      let mark = enigmas[i].childNodes[1].innerHTML;
      createLineEnigmas(title, mark);

    }
  }
}


function createLineEnigmas(title, mark){
  const tableEnigmas = document.getElementById('bestEnigmasTable');
    const lineEnigma = document.createElement('tr');

      const columnTitle = document.createElement('td');
      columnTitle.innerHTML = title;
    lineEnigma.appendChild(columnTitle);

      const columnMark = document.createElement('td');
      columnMark.innerHTML = mark;
    lineEnigma.appendChild(columnMark);

  tableEnigmas.appendChild(lineEnigma);

}
