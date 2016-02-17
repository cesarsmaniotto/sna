<?php

namespace comunic\social_network_analyzer\model\repository\mongo{

	use \comunic\social_network_analyzer\model\repository\IProjectsRepository;
	use comunic\social_network_analyzer\model\entity\mappers\ArrayToProject;
	use comunic\social_network_analyzer\model\entity\mappers\ProjectToArray;
	use comunic\social_network_analyzer\model\util\MongoUtil;

	class ProjectsRepository implements IProjectsRepository{

		private $collection;

		public function __construct($connectionType){


			$conn = new ConnectionMongo();
			$conn = $conn->getConnection($connectionType);
			$this->collection = $conn->selectCollection("projects");
		}

		public function insert($project){

			try {
				$toArray = new ProjectToArray();

				$arrayData = MongoUtil::includeMongoIdObject($toArray($project));

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

			$toProject = new ArrayToProject();

			foreach ($cursor as $item) {

				$outputObjects[]=$toProject(MongoUtil::removeMongoIdObject($item));
			}

			return $outputObjects;

		}

		public function findById($id){
			
			$arrayData=$this->collection->findOne(array('_id' => new \MongoId($id)),$fields=array());

			$toProject = new ArrayToProject();

			return $toProject(MongoUtil::removeMongoIdObject($arrayData));

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

				$toArray = new ProjectToArray();

				$arrayData = MongoUtil::includeMongoIdObject($toArray($project));

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