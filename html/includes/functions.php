<?php
//first param string, second string
//third param 0 if you want all the char of the string
//An integer to limit the number of element of the array (the size)
//retunr an array of string
function spliter($cutParam, $str, $limit) {
    if(gettype($cutParam) !== gettype('c > js')) {
        return 'error first parameter must be a string';
    }
    if(gettype($cutParam) !== gettype('c < js')) {
        return 'error second parameter must be a string';
    }
    if(gettype($limit) != gettype(1)) { 
        return 'error third parameter must be an integer';
    }
    $stringTank ='';
    $length  = strlen($str);//get the length of the string
    $array = [];
    $indexNumb = 0;
    for($i = 0; $i < $length; $i++) {
        if ($str[$i] == $cutParam) {//check the patern
            array_push($array,$stringTank);
            $stringTank ='';
            $indexNumb++;
            $i++;
        } 
        if($i >= $length) break;// if the last char == cutParam
        $stringTank = $stringTank.$str[$i];//concate
        if($limit != 0 && $indexNumb >= $limit) {//to limit the number of elements in the array
            break;
        }
    }
    return $array;
}
?>