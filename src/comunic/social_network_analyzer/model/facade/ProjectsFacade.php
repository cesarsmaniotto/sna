<?php

namespace comunic\social_network_analyzer\model\facade{

	use \comunic\social_network_analyzer\model\projectRepo\IProjectsprojectRepo;

	class ProjectsFacade{

		private $projectRepo;
		private $datasetsRepo;

		public function __construct($projectRepo, $datasetsRepo){
			$this->projectRepo = $projectRepo;
			$this->datasetsRepo = $datasetsRepo;
		}

		public function insert($project_text, $parser){
			$project = $parser->parse($project_text);
			$this->projectRepo->insert($project);
		}

		public function update($project_text,$parser){
			$project = $parser->parse($project_text);
			$this->projectRepo->insert($project);
		}

		public function getDatasets($projectId, $datasetFormatter){
			$project = $this->projectRepo->findById($projectId);
			$datasets = $this->datasetsRepo->findById($project->getDatasetsIds());

			return $datasetFormatter->format($datasets);
		}

		public function findById($id, $formatter){
			return $formatter->format($this->projectRepo->findById($id));
		}

		public function listAll($formatter){
			return $formatter->format($this->projectRepo->listAll());
		}

		public function delete($id){
			$this->projectRepo->delete($id);
		}


	}


}



?>