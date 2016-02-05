<?php

namespace comunic\social_network_analyzer\model\repository\mongo{

use \comunic\social_network_analyzer\model\repository\mongo\MongoCollectionHandler;
use \comunic\social_network_analyzer\model\repository\ICategoriesRepository;
use comunic\social_network_analyzer\model\entity\mappers\ArrayToCategory;
use comunic\social_network_analyzer\model\entity\mappers\CategoryToArray;


class CategoriesRepository implements ICategoriesRepository{

    private $mongoch;

    function __construct($connectionType){
        $this->mongoch = new MongoCollectionHandler('projects',$connectionType);
    }

        public function insert($category, $projectId){

            return $this->mongoch->update(array('_id' => new \MongoId($projectId)), $category,'$addToSet', "categories",  new CategoryToArray());

        }

        public function update($category, $projectId){

            return $this->mongoch->save($category, new CategoryToArray());

        }

        public function delete($id, $projectId){

            return $this->mongoch->delete(array('_id' => new \MongoId($id)));

        }

        public function findById($id, $projectId){

            return $this->mongoch->findOne(new ArrayToCategory(), array('_id' => new \MongoId($id)));

        }

        public function listAll($projectId){

            return $this->mongoch->find(new ArrayToCategory());

        }



}



}



?>