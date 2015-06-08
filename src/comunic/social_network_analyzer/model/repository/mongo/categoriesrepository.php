<?php

namespace comunic\social_network_analyzer\model\repository\mongo{

use \comunic\social_network_analyzer\model\repository\mongo\MongoCollectionHandler;
use \comunic\social_network_analyzer\model\repository\ICategoriesRepository;
use comunic\social_network_analyzer\model\entity\mappers\ArrayToCategory;
use comunic\social_network_analyzer\model\entity\mappers\CategoryToArray;


class CategoriesRepository implements ICategoriesRepository{

    private $mongoch;

    function __construct(){
        $this->mongoch = new MongoCollectionHandler('categories');
    }

        public function insert($category){

            return $this->mongoch->save($category, new CategoryToArray());

        }

        public function update($category){

            return $this->mongoch->save($category, new CategoryToArray());

        }

        public function delete($id){

            return $this->mongoch->delete(array('_id' => new \MongoId($id)));

        }

        public function findById($id){

            return $this->mongoch->findOne(new ArrayToCategory(), array('_id' => new \MongoId($id)));

        }

        public function listAll(){

            return $this->mongoch->find(new ArrayToCategory());

        }



}



}



?>