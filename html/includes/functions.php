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

function isTooLate($timeOld, $timeNow) {
    if($timeNow > $timeOld) { 
        return true;
    }
    return false;
}

/// funtcion do a select from in param  it return an array or false if it wont work
// $arrayColunm => [ id, point,] /
// $table=> table name
// $condition is tring like 'points > 0'
//$ArrayForCondition => [$_Get['id'], $time]
//database set the variable where pdo was set like $bdd
function doSelelctFromFAll($arrayColunm, $table, $condition, $ArrayForCondition,$dataBase) {
    //build the string for the column
    $colunm  = '';
    for ($i = 0; $i < sizeof($arrayColunm) ; $i++) { 
        $colunm = $colunm . ', '. $arrayColunm[$i];
    }
    $dataForExecute = '';
    for ($i = 0; $i < sizeof($ArrayForCondition) ; $i++) { 
        $dataForExecute = $dataForExecute . ', '. $ArrayForCondition[$i];
    }
    $q = 'SELECT '. $colunm . ' FROM ' . $table . ' WHERE '.$condition;
    $req = $dataBase ->prepare($q);
    $req->execute([$dataForExecute]);
    $results = $req->fetchAll(PDO::FETCH_ASSOC);
    if(sizeof($results) > 0) {
        return $results;
    }
    return false;
}

/// funtcion do a select from in param it return an array or false if it wont work
// $arrayColunm => [ id, point,] /
// $table=> table name
// $condition is tring like 'points > 0'
//$ArrayForCondition => [$_Get['id'], $time]
//database set the variable where pdo was set like $bdd
function doSelelctFromFetch($arrayColunm, $table, $condition, $ArrayForCondition,$dataBase) {
    $colunm  = '';
    for ($i = 0; $i < sizeof($arrayColunm) ; $i++) { 
        $colunm = $colunm . ', '. $arrayColunm[$i];
    }
    $dataForExecute = '';
    for ($i = 0; $i < sizeof($ArrayForCondition) ; $i++) { 
        $dataForExecute = $dataForExecute . ', '. $ArrayForCondition[$i];
    }
    $q = 'SELECT '. $colunm . ' FROM ' . $table . ' WHERE '.$condition;
    $req = $dataBase ->prepare($q);
    $req->execute([$dataForExecute]);
    $results = $req->fetch(PDO::FETCH_ASSOC);
    if(sizeof($results) > 0) {
        return $results;
    }
    return false;
}

// its the same function as fuction doSelelctFromFetch
//it return only a boolan true if the line existing
// false if don't
function existingInbdd($arrayColunm, $table, $condition, $ArrayForCondition,$dataBase) {
    $colunm  = '';
    for ($i = 0; $i < sizeof($arrayColunm) ; $i++) { 
        $colunm = $colunm . ', '. $arrayColunm[$i];
    }
    $dataForExecute = '';
    for ($i = 0; $i < sizeof($ArrayForCondition) ; $i++) { 
        $dataForExecute = $dataForExecute . ', '. $ArrayForCondition[$i];
    }
    $q = 'SELECT '. $colunm . ' FROM ' . $table . ' WHERE '.$condition;
    $req = $dataBase ->prepare($q);
    $req->execute([$dataForExecute]);
    $results = $req->fetch(PDO::FETCH_ASSOC);
    if(sizeof($results) > 0) {
        return true;
    }
    return false;
}

function NoCondiSelectFrom($arrayColunm, $table,$dataBase) {
    $colunm  = '';
    for ($i = 0; $i < sizeof($arrayColunm) ; $i++) { 
        $colunm = $colunm . ', '. $arrayColunm[$i];
    }
    $q = 'SELECT '. $colunm . ' FROM ' . $table ;
    $req = $dataBase ->prepare($q);
    $req->execute([]);
    $results = $req->fetch(PDO::FETCH_ASSOC);
    if(sizeof($results) > 0) {
        return $results;
    }
    return false;
}
?>