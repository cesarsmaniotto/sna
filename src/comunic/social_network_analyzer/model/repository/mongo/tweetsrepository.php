<?php

namespace \comunic\social_network_analyzer\model\repository\mongo{

    use \comunic\social_network_analyzer\model\repository\mongo\MongoConnectionHandler;
    use \comunic\social_network_analyzer\model\repository\ITweetsRepository;


    class TweetsRepository implements ITweetsRepository{

        private $mongoch;

        function __construct(){
            $this->mongoch = new MongoConnectionHandler('tweets');
        }

        public function insert($tweet){

        }


        public function listAll(){

        }

        public function findById($id){

        }

        public function listByCategory( $category){

        }



    }



}



?>