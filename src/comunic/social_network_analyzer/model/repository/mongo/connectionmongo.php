<?php

namespace comunic\social_network_analyzer\model\repository\mongo{



class ConnectionMongo{

    private $dbUser = "";
    private $dbPwd = "";
    private $dbName = 'teste';
    private $dbPort = "27017";
    private $dbHost ="localhost";

    private function getURL(){
         return "mongodb://".$this->dbUser.":".$this->dbPwd."@".$this->dbHost.":".$this->dbPort;
    }

    public function getConnection(){

        try {

           //$conn = new \Mongo($this->getURL());
            $conn = new \Mongo();
            return $conn->selectDB($this->dbName);

        } catch (\MongoConnectionException $e) {
            echo $e->getMessage();
        }
    }

}

}



