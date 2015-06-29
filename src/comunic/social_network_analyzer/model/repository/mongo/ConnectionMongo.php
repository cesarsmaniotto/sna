<?php

namespace comunic\social_network_analyzer\model\repository\mongo{



class ConnectionMongo{

    // private $dbUser = "";
    // private $dbPwd = "";
    // private $dbName = 'unity_test';
    // private $dbPort = "27017";
    // private $dbHost ="localhost";

    private $connectionInfo = array(
        "development" => array(
            "dbName" => "development"
            ),

        "comunic" => array(
            "dbName" => "teste"
            )

        );

    private function getURL(){
         return "mongodb://".$this->dbUser.":".$this->dbPwd."@".$this->dbHost.":".$this->dbPort;
    }

    public function getConnection($type){

        try {

           //$conn = new \Mongo($this->getURL());
            $conn = new \Mongo();
            return $conn->selectDB($this->connectionInfo[$type]["dbName"]);

        } catch (\MongoConnectionException $e) {
            echo $e->getMessage();
        }
    }

}

}



