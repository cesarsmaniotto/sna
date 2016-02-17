<?php

namespace comunic\social_network_analyzer\model\repository\mongo{

    use \comunic\social_network_analyzer\model\repository\ICategoriesRepository;
    use comunic\social_network_analyzer\model\entity\mappers\ArrayToCategory;
    use comunic\social_network_analyzer\model\entity\mappers\CategoryToArray;
    use comunic\social_network_analyzer\model\util\MongoUtil;


    class CategoriesRepository implements ICategoriesRepository{

        private $collection;

        function __construct($connectionType){
            $conn = new ConnectionMongo();
            $conn = $conn->getConnection($connectionType);
            $this->collection = $conn->selectCollection("projects");
        }

        public function insert($category, $projectId){

            try {

                $toArray = new CategoryToArray();

                $arrayData = MongoUtil::includeMongoIdObject($toArray($category));

                return $this->collection->update(array('_id' => new \MongoId($projectId)), array('$addToSet' => array("categories" => $arrayData)), $options=array());

            } catch (\MongoCursorException $e) {

                echo $e->getMessage();

            }catch (\MongoException $e) {

                echo $e->getMessage();
            }
        }

        public function update($category, $projectId){

            $this->delete($category->getId(), $projectId);

            $this->insert($category, $projectId);

        }

        public function delete($id, $projectId){

            return $this->collection->update(array('_id' => new \MongoId($projectId)), array('$pull' => array("categories" => array("_id" => new \MongoId($id)))), $options=array());

        }

        public function findById($id){

         $arrayData=$this->collection->findOne(array('categories._id' => new \MongoId($id)), array("categories.$" => true, "_id" => false), $fields=array());

         $toCategory = new ArrayToCategory();

         return $toCategory(MongoUtil::removeMongoIdObject($arrayData["categories"][0]));

     }

     public function listAll($projectId){

        return $this->mongoch->find(new ArrayToCategory());

    }



}



}



?>