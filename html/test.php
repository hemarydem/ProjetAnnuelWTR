<?php
    session_start();
    require('includes/config.php');
       // require('includes/functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    function doSelelctFromFetch($arrayColunm, $strTable, $strCondition, $ArrayForCondition,$dataBase) {
        $colunm  = '';
        if( sizeof($arrayColunm) > 1){
             for ($i = 0; $i < sizeof($arrayColunm) ; $i++) { 
                 $colunm = $colunm . ', '. $arrayColunm[$i];
             }
        }else{
             $colunm = $arrayColunm[0];
        }
        $dataForExecute = '';
        if( sizeof($ArrayForCondition) > 1){ 
             for ($i = 0; $i < sizeof($ArrayForCondition) ; $i++) { 
                 $dataForExecute = $dataForExecute . ', '. $ArrayForCondition[$i];
             }
        }else{
             $dataForExecute = $ArrayForCondition[0];
        }
        $q = 'SELECT '. $colunm . ' FROM ' . $strTable . ' WHERE '.$strCondition;
        echo 'le select '.$q . '<br>';
        $req = $dataBase ->prepare($q);
        echo '<br>'.$req->execute([$dataForExecute]);
        $results = $req->fetch(PDO::FETCH_ASSOC);
        echo '<br> results'.$results;
        echo '<br>'.gettype($results);
        if($results) {
            return $results;
        }
        return false;
    }


    function insert($tab1, $arrayColunm1, $arrayValues1, $dataBase1) {
        $colunm  = '';
        $valuesQueryStinrg = '';
        $condition = '';
        if( sizeof($arrayColunm1) > 1){
             for ($i = 0; $i < sizeof($arrayColunm1) ; $i++) { 
                 echo $colunm = $colunm . ','. $arrayColunm1[$i]."<br>";//;
                 //condition is for the existing
                echo $condition = $condition.' AND '.$arrayColunm1[0].' = ?'."<br>";//;
                echo $valuesQueryStinrg = $valuesQueryStinrg.', '.$arrayColunm1[0].' = ?'."<br>";//;
             }
        }else{
           echo  $colunm = $arrayColunm1[0] ."<br>";//;
            echo  $condition = $arrayColunm1[0].' = ?' ."<br>";//;
             echo $valuesQueryStinrg = $condition ."<br>";//;
        }
        $dataForExecute = '';
        if( sizeof($arrayValues1) > 1){ 
             for ($i = 0; $i < sizeof($arrayValues1) ; $i++) { 
                echo $dataForExecute = $dataForExecute . ','. $arrayValues1[$i];
                 "<br>";//;
             }
        }else{
             echo $dataForExecute = '"data" : =>'$arrayValues1[0];
        }
        echo  $colunm;
        echo $q = 'INSERT INTO '.$tab1.' ('. $colunm . ') ' .'VALUES ' . $dataForExecute. '' ."<br>";//;
         $req = $dataBase1 ->prepare($q);
        $req->execute([$dataForExecute]);
    
        
        $results = doSelelctFromFetch($arrayColunm1,$tab1, $condition, $arrayValues1, $dataBase1);
    
    }
    $tab = 'tag';
    $colunms = 'name';
    $value = "tropBien";

    $data = insert($tab,[$colunms],[$value],$bdd);
    echo '<br>data = '. $data;

    ?>
</body>
</html>