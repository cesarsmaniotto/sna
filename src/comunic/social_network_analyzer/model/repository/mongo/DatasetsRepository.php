<?php

namespace comunic\social_network_analyzer\model\repository\mongo{

    use comunic\social_network_analyzer\model\repository\IDatasetsRepository;
    use comunic\social_network_analyzer\model\entity\mappers\DatasetToArray;
    use comunic\social_network_analyzer\model\entity\mappers\ArrayToDataset;
    use comunic\social_network_analyzer\model\util\MongoUtil;

    class DatasetsRepository implements IDatasetsRepository{

        private $collection;

        function __construct($connectionType){
            $conn = new ConnectionMongo();
            $conn = $conn->getConnection($connectionType);
            $this->collection = $conn->selectCollection("projects");
        }

        public function insert($object,$projectId){

            try {

                $toArray = new DatasetToArray();

                $arrayData = MongoUtil::includeMongoIdObject($toArray($object));

                return $this->collection->update(array('_id' => new \MongoId($projectId)), array('$addToSet' => array("datasets" => $arrayData)), $options=array());

            } catch (\MongoCursorException $e) {

                echo $e->getMessage();

            }catch (\MongoException $e) {

                echo $e->getMessage();
            }

        }



        public function update($object, $projectId){

            $this->delete($object->getId(), $projectId);

            $this->insert($object, $projectId);

        }

        public function delete($id, $projectId){

            return $this->collection->update(array('_id' => new \MongoId($projectId)), array('$pull' => array("datasets" => array("_id" => new \MongoId($id)))), $options=array());

        }

        public function findById($id){

            $arrayData=$this->collection->findOne(array('datasets._id' => new \MongoId($id)), array("datasets.$" => true, "_id" => false), $fields=array());

            $toDataset = new ArrayToDataset();

            return $toDataset(MongoUtil::removeMongoIdObject($arrayData["datasets"][0]));
        }

        public function listAll($projectId){

            return $this->mongoch->find(new ArrayToDataset());
        }

    }

}


?>