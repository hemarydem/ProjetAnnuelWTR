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
    function doSelelctFromFAll($arrayColunm, $table, $condition, $ArrayForCondition,$dataBase) {
        //build the string for the column
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
        $q = 'SELECT '. $colunm . ' FROM ' . $table . ' WHERE '.$condition;
        $req = $dataBase ->prepare($q);
        echo $dataForExecute;
        $req->execute([$dataForExecute]);
        $results = $req->fetchAll(PDO::FETCH_ASSOC);
        if(sizeof($results) > 0) {
            return $results;
        }
        return false;
    }
    
    $data = doSelelctFromFAll(['*'], 'user', 'idUser = ?', ['3'],$bdd);
    print_r($data);

    ?>
</body>
</html>