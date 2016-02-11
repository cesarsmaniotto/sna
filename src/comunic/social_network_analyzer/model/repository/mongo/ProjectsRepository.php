<?php

namespace comunic\social_network_analyzer\model\repository\mongo{

	use \comunic\social_network_analyzer\model\repository\mongo\MongoCollectionHandler;
	use \comunic\social_network_analyzer\model\repository\IProjectsRepository;
	use comunic\social_network_analyzer\model\entity\mappers\ArrayToProject;
	use comunic\social_network_analyzer\model\entity\mappers\ProjectToArray;
	use comunic\social_network_analyzer\model\repository\mongo\mappers\ObjectToArrayWithMongoId;
	use comunic\social_network_analyzer\model\repository\mongo\mappers\ArrayWithMongoIdToObject;

	class ProjectsRepository implements IProjectsRepository{

		private $collection;

		public function __construct($connectionType){


			$conn = new ConnectionMongo();
			$conn = $conn->getConnection($connectionType);
			$this->collection = $conn->selectCollection("projects");
		}

		public function insert($project){

			try {
				$fObjToArrayWithMongoId = new ObjectToArrayWithMongoId();

				$arrayData=$fObjToArrayWithMongoId($project, new ProjectToArray());

				return $this->collection->save($arrayData, $options=array());

			} catch (\MongoCursorException $e) {

				echo $e->getMessage();

			}catch (\MongoException $e) {

				echo $e->getMessage();
			}
		}

		public function listAll(){

			$cursor=$this->collection->find($query=array(),$fields=array());

			$outputObjects=array();

			$fArrayWithMongoIdToObj = new ArrayWithMongoIdToObject();

			foreach ($cursor as $item) {
				$outputObjects[]=$fArrayWithMongoIdToObj($item, new ArrayToProject());
			}

			return $outputObjects;

		}

		public function findById($id){
			
			$arrayData=$this->collection->findOne(array('_id' => new \MongoId($id)),$fields=array());

			$fArrayWithMongoIdToObj = new ArrayWithMongoIdToObject();

			return $fArrayWithMongoIdToObj($arrayData, new ArrayToProject());

		}

		public function delete($id){

			try {

				return $this->collection->remove(array('_id' => new \MongoId($id)), $options=array());

			} catch (\MongoCursorException $e) {

				echo $e->getMessage();
			}
		}

		public function update($project){
			try {
				$fObjToArrayWithMongoId = new ObjectToArrayWithMongoId();

				$arrayData=$fObjToArrayWithMongoId($project, new ProjectToArray());

				return $this->collection->save($arrayData, $options=array());

			} catch (\MongoCursorException $e) {

				echo $e->getMessage();

			}catch (\MongoException $e) {

				echo $e->getMessage();
			}
		}



	}

}

?>