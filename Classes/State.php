<?php
error_reporting(E_ALL);
include_once("Db.php");
class State extends Db{

    public function fetch_states(){
        $sql="SELECT * FROM state";
        $stmt=$this->connect()->prepare($sql);
        $stmt->execute();
        $state=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $state;

    }

    public function fetch_lga($state_id){
        $sql="SELECT * FROM lga WHERE state_id =?";
        $stmt=$this->connect()->prepare($sql);
        $stmt->bindParam(1,$state_id,PDO::PARAM_INT);
        $stmt->execute();
        $lga=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $lga;

    }
}

// $lga= new State();
// $lgas=$lga->fetch_lga();
// print_r($lgas);
?>