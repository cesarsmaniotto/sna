<?php

namespace comunic\social_network_analyzer\model\repository\arango{

	use comunic\social_network_analyzer\model\repository\IDatasetsRepository;
	use comunic\social_network_analyzer\model\entity\mappers\ArrayToDataset;
	use comunic\social_network_analyzer\model\entity\mappers\DatasetToArray;


	class DatasetsRepository extends AbstractArangoRepository implements IDatasetsRepository{
		
		function __construct(){
			parent::__construct();

			$this->entityName = "datasets";
		}

		public function insert($dataset, $projectId){
			$datasetVertex = $this->graphHandler->createVertex($dataset, new DatasetToArray(), $this->entityName);

			$projectId = $this->buildId("projects", $projectId);

			return $this->graphHandler->createEdge($projectId, $datasetVertex, "projects_datasets_has","projects_datasets_has");
		}

		public function filterByProject($projectId){
			$projectId = $this->buildId("projects", $projectId);

			$edges = $this->graphHandler->getConnectedEdges($projectId,"projects_datasets_has");

			$datasets = array();
			foreach ($edges->getAll() as $edge) {
				$datasets[] = $this->graphHandler->getVertex($edge->getTo() ,new ArrayToDataset());
			}

			return $datasets;
		}

		public function update($dataset){
			$id = $this->buildId($this->entityName, $dataset->getId());
			return $this->graphHandler->updateVertex($id, $dataset, new DatasetToArray());
		}

		public function delete($id){
			$id = $this->buildId($this->entityName, $id);
			return $this->graphHandler->deleteVertex($id);
		}

		public function listAll(){

			return $this->graphHandler->listVertex($this->entityName,new ArrayToDataset());
		}

		public function findById($id){
			$id = $this->buildId($this->entityName, $id);
			return $this->graphHandler->getVertex($id, new ArrayToDataset());

		}

	}

	


}

?>