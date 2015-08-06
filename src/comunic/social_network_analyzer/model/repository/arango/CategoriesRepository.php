<?php

namespace comunic\social_network_analyzer\model\repository\arango{

	use comunic\social_network_analyzer\model\repository\ICategoriesRepository;
	use comunic\social_network_analyzer\model\entity\mappers\ArrayToCategory;
	use comunic\social_network_analyzer\model\entity\mappers\CategoryToArray;

	class CategoriesRepository extends AbstractArangoRepository implements ICategoriesRepository{
		
		function __construct(){
			parent::__construct();

			$this->entityName = "categories";
			$this->collHandler->setCollection($this->entityName);

		}

		public function insert($project){
			return $this->graphHandler->createVertex($project, new CategoryToArray(), $this->entityName);
		}

		public function update($project){
			$id = $this->mountId($this->entityName, $project->getId());
			return $this->graphHandler->updateVertex($id, $project, new CategoryToArray());
		}

		public function delete($id){
			$id = $this->mountId($this->entityName, $id);
			return $this->graphHandler->deleteVertex($id);
		}

		public function listAll(){
			return $this->graphHandler->listVertex($this->entityName, new ArrayToCategory());
			// return $this->collHandler->listDocuments(new ArrayToCategory());
		}

		public function findById($id){
			$id = $this->mountId($this->entityName, $id);
			return $this->graphHandler->getVertex($id, new ArrayToCategory());

		}

	}

	


}

?>