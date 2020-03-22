<?php

	$_SESSION['captcha'] = false;


	$position = imagecreatetruecolor(60,50);

	//colors
	$white = imagecolorallocate($position, 238, 238, 238);
	$orange = imagecolorallocate($position, 220, 100, 0);
	$blue = imagecolorallocate($position, 10, 10, 100);
	$red = imagecolorallocate($position, 120, 0, 0);
	$pink = imagecolorallocate($position, 200, 80, 80);
	$black = imagecolorallocate($position, 0, 0, 0);

	//arrays of parameters
	$colors = [$orange, $blue, $red, $pink, $black];
	$fonts = ['UrbanInline.ttf', 'All Star Resort.ttf', 'Sweet Hipster.ttf'];
	$sizes = [20, 24, 28];
	$angles = [-15, 0, 15];
	$letters = ['A','B','C','D'];
	$digits = ['1','2','3','4'];

	imagefill($position, 0, 0, $white);

	$initialPosition = 'B2';

	do {
		$letter = $letters[array_rand($letters)];
		$digit = $digits[array_rand($digits)];
		$string = $letter . $digit;
	} while ($string == $initialPosition);


	//letter
	$color = $colors[array_rand($colors)];
	$font = 'style/fonts/' . $fonts[array_rand($fonts)];
	$size = $sizes[array_rand($sizes)];
	$angle = $angles[array_rand($angles)];
	imagettftext($position, $size, $angle, 5, 40, $color, $font, $letter);

	//digit
	$color = $colors[array_rand($colors)];
	$font = 'style/fonts/' . $fonts[array_rand($fonts)];
	$size = $sizes[array_rand($sizes)];
	$angle = $angles[array_rand($angles)];
	imagettftext($position, $size, $angle, 35, 40, $color, $font, $digit);

	$_SESSION['position'] = $string;

	imagepng($position, 'img/captcha/position.png');


 ?>
 <div id="captchaContainer">
 	<p>Déplacez M. Sananes en</p><img src="img/captcha/position.png" alt="position">
 	<img id="pawn" src="img/captcha/Frederic_Sananes.png">
 	<img id="chessboard" src="img/captcha/chessboard.svg">
 	<div id="chessboardBG">
 		<canvas id="captcha">échiquier</canvas>
 	</div>
