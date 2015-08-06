<?php

namespace comunic\social_network_analyzer\model\facade\arango{

	use comunic\social_network_analyzer\model\repository\IProjectsRepository;
	use comunic\social_network_analyzer\model\repository\IDatasetsRepository;

	class ProjectsFacade{

		private $projectRepo;

		public function __construct($projectRepo){
			$this->projectRepo = $projectRepo;
		}

		public function insert($project_text, $parser){
			$project = $parser->parse($project_text);
			return $this->projectRepo->insert($project);
		}

		public function update($project_text,$parser){
			$project = $parser->parse($project_text);
			$this->projectRepo->update($project);
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