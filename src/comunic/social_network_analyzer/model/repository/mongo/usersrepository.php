<?php

namespace comunic\social_network_analyzer\model\repository\mongo{

    use \comunic\social_network_analyzer\model\repository\mongo\MongoCollectionHandler;
    use \comunic\social_network_analyzer\model\repository\IUsersRepository;


    class UsersRepository implements IUsersRepository{

        private $mongoch;

        function __construct(){
            $this->mongoch = new MongoCollectionHandler('users');
        }

        public function insert($user){

        }

        public function update($user){

        }

        public function delete($id){


        }

        public function findById($id){

        }

        public function listAll(){

        }



    }



}



?>