<?php

namespace comunic\social_network_analyzer\model\repository\mongo{

use comunic\social_network_analyzer\model\repository\IDatasetsRepository;
use comunic\social_network_analyzer\model\entity\mappers\DatasetToArray;
use comunic\social_network_analyzer\model\entity\mappers\ArrayToDataset;
use comunic\social_network_analyzer\model\util\idGenerator\IdMongoGenerator;

class DatasetsRepository implements IDatasetsRepository{

    private $mongoch;

    function __construct($connectionType){
        $this->mongoch = new MongoCollectionHandler("projects",$connectionType);
    }

    public function insert($object,$projectId){

        return $this->mongoch->update(array('_id' => new \MongoId($projectId)), $object,'$addToSet', "datasets",  new DatasetToArray());
    }

    public function update($object, $projectId){

        return $this->mongoch->save($object, new DatasetToArray());
    }

  public function delete($id, $projectId){

        return $this->mongoch->delete(array("_id" => new \MongoId($id)));

    }

    public function findById($id, $projectId){

        if(is_array($id)){
            $arrayObj = array();

            foreach ($id as $item) {
                $arrayObj[] = $this->mongoch->findOne(new ArrayToDataset(), array("_id" => new \MongoId($item)));
            }

            return $arrayObj;
        }

        return $this->mongoch->findOne(new ArrayToDataset(), array("_id" => new \MongoId($id)));

    }

    public function listAll($projectId){

        return $this->mongoch->find(new ArrayToDataset());
    }

}

}


?>