<?php
error_reporting(E_ALL);
require "../Classes/State.php";
if($_POST){
    $state_id=$_POST["stateid"];

    $lg=new State();
    $lga=$lg->fetch_lga($state_id);
    
    $lg_options=""; 
    foreach($lga as $local){
        $lg_name=$local['lga_name']; 
        $lg_options .="<option value='$lg_name'> $lg_name </option>"; 
        
    }
    echo $lg_options;
}
?>