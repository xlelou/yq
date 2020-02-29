<?php
    error_reporting(E_ALL^E_NOTICE);
    function returnArray($q){
        $data = [];
        while($row = $q->fetch_assoc()){
            array_push($data,$row);
        }
        return $data;
    }
    
    
    $mysqli = new mysqli('', 'root', '', 'yiqingdb');
    
    if ($mysqli->connect_error) {
        die('Connect Error (' . $mysqli->connect_errno . ') '
                . $mysqli->connect_error);
    }
?>
