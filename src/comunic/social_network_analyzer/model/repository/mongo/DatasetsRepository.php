<?php

namespace comunic\social_network_analyzer\model\repository\mongo{

use comunic\social_network_analyzer\model\repository\IDatasetsRepository;
use comunic\social_network_analyzer\model\entity\mappers\DatasetToArray;
use comunic\social_network_analyzer\model\entity\mappers\ArrayToDataset;

class DatasetsRepository implements IDatasetsRepository{

    private $mongoch;

    function __construct(){
        $this->mongoch = new MongoCollectionHandler("datasets");
    }

    public function insert($object){

        return $this->mongoch->save($object, new DatasetToArray());
    }

    public function update($object){

        return $this->mongoch->save($object, new DatasetToArray());

    }

    public function delete($id){

        return $this->mongoch->delete(array("_id" => new \MongoId($id)));

    }

    public function findById($id){

        return $this->mongoch->findOne(new ArrayToDataset(), array("_id" => new \MongoId($id)));

    }

    public function listAll(){

        return $this->mongoch->find(new ArrayToDataset());
    }

}

}


?>