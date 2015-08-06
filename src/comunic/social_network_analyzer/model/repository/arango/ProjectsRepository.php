<?php

namespace comunic\social_network_analyzer\model\repository\arango{

	use comunic\social_network_analyzer\model\repository\IProjectsRepository;
	use comunic\social_network_analyzer\model\entity\mappers\ArrayToProject;
	use comunic\social_network_analyzer\model\entity\mappers\ProjectToArray;

	class ProjectsRepository extends AbstractArangoRepository implements IProjectsRepository{
		
		function __construct(){
			parent::__construct();

			$this->entityName = "projects";
			$this->collHandler->setCollection($this->entityName);

		}

		public function insert($project){
			return $this->graphHandler->createVertex($project, new ProjectToArray(), $this->entityName);
		}

		public function update($project){
			$id = $this->mountId($this->entityName, $project->getId());
			return $this->graphHandler->updateVertex($id, $project, new ProjectToArray());
		}

		public function delete($id){
			$id = $this->mountId($this->entityName, $id);
			return $this->graphHandler->deleteVertex($id);
		}

		public function listAll(){
			return $this->graphHandler->listVertex($this->entityName, new ArrayToProject());
		}

		public function findById($id){
			$id = $this->mountId($this->entityName, $id);
			return $this->graphHandler->getVertex($id, new ArrayToProject());

		}

	}

	


}

?>