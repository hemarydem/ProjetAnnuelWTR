
let xArray = [];
let yArray = [];


function trackingCanvas(idCanvas,abscissaArray,ordinateArray){


  const canvas = document.getElementById(idCanvas);
  const ctx = canvas.getContext('2d');



  let width = 500;
  let height = 300;
  canvas.width = width;
  canvas.height = height;
  ctx.fillStyle = "#1c2224";
  ctx.fillRect(0, 0, width, height);

  width -=  40;
  height -= 40;


  //________DATES
  //get the range of the dates
  let yearLastDate = splitDate(abscissaArray[0])['year'];
  let monthLastDate = splitDate(abscissaArray[0])['month'];
  let dayLastDate = splitDate(abscissaArray[0])['day'];
  let lastDate = new Date(yearLastDate,monthLastDate - 1,dayLastDate);
  let firstDate = new Date(yearLastDate,monthLastDate - 1,dayLastDate - 21);

  //return an array without the dates older than 21 days before the most recent
  abscissaArray = removeOldDates(abscissaArray);
  function removeOldDates(dates){
    let newDates = [];
    for(let i = 0; i < dates.length; i++){
      let year = splitDate(dates[i])['year'];
      let month = splitDate(dates[i])['month'];
      let day = splitDate(dates[i])['day'];
      let date = new Date(year,month - 1,day);

      if( Date.parse(date) >= Date.parse(firstDate) ){
        newDates[i] = dates[i];
      }
      else break;
    }

    return newDates;
  }

  // get only the days
  for(let i = 0; i < abscissaArray.length; i++){
    abscissaArray[i] = splitDate(abscissaArray[i])['day'];
  }

  // days from past month in negatives
  for(let i = 0; i < abscissaArray.length; i++){
    if( abscissaArray[i] > abscissaArray[i-1] ){
      let endOfTheMonth = abscissaArray[i];
      for(let j = i; j < abscissaArray.length; j++ ){
        abscissaArray[j] -= endOfTheMonth;
      }

    }
  }


  function splitDate(date){
    let array = {
      "year": date.split('-')[0],
      "month": date.split('-')[1],
      "day": date.split('-')[2],
   }
    return array;
  }

  // ________________________
  //
  //
  //________DRAW THE GRAPHIC
  graphic(abscissaArray, ordinateArray);
  function graphic(abscissaArray, ordinateArray){

    // get the value of the top of the graph
    function ceiling(y){
      let magnitude = 1;
      for(let i = 0; i < y.length - 1; i++) magnitude *= 10;
      return ( Math.trunc( parseInt(y) / magnitude ) + 1 ) * magnitude;
    }

    //Scales
    let scaleY = height / ceiling( maxInArray(ordinateArray) );
    let scaleX = width / 21;

    //draw the axes infos
    // y
    for(let i = 0; i < height/scaleY + 1 ; i++){
      ctx.font = "10px Helvetica";
      ctx.fillStyle = "#fff";
      let yValue = height/scaleY - i;
      ctx.fillText( yValue , width + 25, i * scaleY + 17 );

      ctx.beginPath();
      ctx.setLineDash([5, 15]);
      ctx.moveTo(15, yValue * scaleY + 15);
      ctx.lineTo(width + 15, yValue * scaleY + 15);
      ctx.closePath();
      ctx.strokeStyle = '#555555';
      ctx.stroke();
    }
    // x
    for(let i = 0; i < 21 ; i+= 21/7){
      ctx.font = "10px Helvetica";
      ctx.fillStyle = "#fff";
      let xValue = abscissaArray[20 - i];
      ctx.fillText( xValue, i * scaleX +  15, height + 30 );

      ctx.beginPath();
      ctx.setLineDash([5, 15]);
      ctx.moveTo( i * scaleX + 15 , 15);
      ctx.lineTo( i * scaleX +  15, height + 15);
      ctx.closePath();
      ctx.strokeStyle = '#555555';
      ctx.stroke();
    }
    ctx.setLineDash([]);



    //translation to the left of the canvas
    let offset = abscissaArray[abscissaArray.length - 1];
    for(let i = 0; i < abscissaArray.length; i++ )abscissaArray[i] -= offset;


    //draw the points
    for(let i = 0; i < abscissaArray.length; i++){

      let x = abscissaArray[i] * scaleX + 15;
      let y = downThePoint(ordinateArray[i] * scaleY) + 15;
      drawPointGraph( x, y,'#ffa722');
    }

    function drawPointGraph(x,y, color){
      ctx.beginPath();
      ctx.arc(x, y, 4, 0, Math.PI * 2, true);
      ctx.fillStyle = color;
      ctx.fill();
    }

    //draw the lines
    drawLinesGraph(abscissaArray, ordinateArray);
    function drawLinesGraph(xArray, yArray){
      for(let i = 0; i < xArray.length - 1; i++){
        let day1 = xArray[i] * scaleX + 15;
        let day2 = xArray[i+1] * scaleX + 15;
        let y1 = downThePoint(yArray[i] * scaleY) + 15;
        let y2 = downThePoint(yArray[i+1] * scaleY) + 15;
        drawLine( day1, y1, day2, y2, '#ffa722' );
      }
    }

    function drawLine(x1, y1, x2, y2, color){
      ctx.beginPath();
      ctx.moveTo(x1, y1);
      ctx.lineTo(x2, y2);
      ctx.closePath();
      ctx.strokeStyle = color;
      ctx.stroke();
    }
  }

  //________________________



  function maxInArray(array){
    let max = 0;
    for(let i = 0; i < array.length; i++)
      if(array[i] > max) max = array[i];
    return max;// return the max value of the array
  }


  // transform the y, abscissa: bottom to top
  function downThePoint(y){
    y += ( (height/2) - y )*2;
    return y;
  }

}
