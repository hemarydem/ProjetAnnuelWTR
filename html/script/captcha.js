window.onload = function(){


	let canvas = document.getElementById('captcha');
	let ctx = canvas.getContext('2d');

	//integration de l'échiquier et du pion
	let chessboard = document.getElementById('chessboard');
	let pawn = document.getElementById('pawn');

	let size = canvas.height = canvas.width = 256; //taille du canvas
	let chessboardSize = 4;		// 4 * 4 cases sur l'échiquier
	let scale = size / chessboardSize;


	//x et y initiales du pion
	let xPawn = scale * 1;
	let yPawn = scale * 2;
	let offset = {};

	// position du canvas sur la fenêtre
	let xCanvas = captcha.getBoundingClientRect().left;
	let yCanvas = captcha.getBoundingClientRect().top;

	drawChessboard();

	function drawChessboard(){
		ctx.clearRect(0, 0, size, size); //clear le canvas
		ctx.drawImage(chessboard, 0, 0, size, size); // afficher le damier
		ctx.drawImage(pawn, xPawn , yPawn , scale, scale); // afficher le pion
	};


	//détection d'un click
	document.body.addEventListener('mousedown', function(event){
		drawChessboard();


		offset.x = event.clientX - xPawn - captcha.getBoundingClientRect().left;
		offset.y = event.clientY - yPawn - captcha.getBoundingClientRect().top;

		xCanvas = captcha.getBoundingClientRect().left;
		yCanvas = captcha.getBoundingClientRect().top;

		//si la souris est sur le pion
		if( ( event.clientX >= xCanvas + xPawn ) && ( event.clientX <= xCanvas + xPawn + scale )
		 && ( event.clientY >= yCanvas + yPawn ) && ( event.clientY <= yCanvas + yPawn + scale ) ){
			document.body.addEventListener("mousemove", onMouseMove);
			document.body.addEventListener("mouseup", onMouseUp);

		}

	});


	// Quand la souris bouge
	function onMouseMove(event){

			xCanvas = captcha.getBoundingClientRect().left;
			yCanvas = captcha.getBoundingClientRect().top;

		//coordonnées du pion = celles de la souris
				xPawn = event.clientX - xCanvas - offset.x;
				yPawn = event.clientY - yCanvas - offset.y;


		//on efface l'ancien pion puis affiche le nouveau avec les bonnes coordonnées
		drawChessboard();
	}




	// Quand on déclick
	function onMouseUp(event){

		xCanvas = captcha.getBoundingClientRect().left;
		yCanvas = captcha.getBoundingClientRect().top;


		if( event.clientX < scale * 1 + xCanvas)
			xPawn = 0;
		else if (event.clientX < scale * 2 + xCanvas)
			xPawn = scale * 1;
		else if (event.clientX < scale * 3 + xCanvas)
			xPawn = scale * 2;
		else
			xPawn = scale * 3;


		if( event.clientY < scale * 1 + yCanvas)
			yPawn = 0;
		else if (event.clientY < scale * 2 + yCanvas)
			yPawn = scale * 1;
		else if (event.clientY < scale * 3 + yCanvas)
			yPawn = scale * 2;
		else
			yPawn = scale * 3;


		drawChessboard();


		document.body.removeEventListener("mousemove", onMouseMove);
		document.body.removeEventListener("mouseup", onMouseUp);


		//transformer les coordonnées en string,  ex: (scale * 1 ,0) = 'B4'
		let chessboardBox = {};
		if(xPawn === 0) 				chessboardBox.letter = 'A';
		if(xPawn === scale * 1) chessboardBox.letter = 'B';
		if(xPawn === scale * 2) chessboardBox.letter = 'C';
		if(xPawn === scale * 3) chessboardBox.letter = 'D';

		if(yPawn === 0) 				chessboardBox.number = '4'; 	// les y vont vers le bas
		if(yPawn === scale * 1) chessboardBox.number = '3';
		if(yPawn === scale * 2) chessboardBox.number = '2';
		if(yPawn === scale * 3) chessboardBox.number = '1';

		chessboardBox = chessboardBox.letter.concat(chessboardBox.number);

		sendPosition(chessboardBox);
	// Envoyer les x et y au php
		function sendPosition(position){
			let xhr = new XMLHttpRequest();

			xhr.onreadystatechange = function(){
				if(this.readyState == 4 && this.status == 200){
					console.log(this.response);
				}else if (this.readyState == 4 && this.status !== 200) {
					alert("Erreur");
				}
			};

			xhr.open("POST", "../../includes/positionValidator.php", true);
			xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xhr.send("position=" + position);


		}

	}


};
