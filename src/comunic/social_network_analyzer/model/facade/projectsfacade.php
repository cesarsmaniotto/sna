<?php

namespace comunic\social_network_analyzer\model\facade{

	use \comunic\social_network_analyzer\model\repository\IProjectsRepository;

	class ProjectsFacade{

		private $repository;

		public function __construct($repository){
			$this->repository = $repository;
		}

		public function insert($project_text, $parser){
			$project = $parser->parse($project_text);
			$this->repository->insert($project);
		}

		public function update($project_text,$parser){
			$project = $parser->parse($project_text);
			$this->repository->insert($project);
		}

		public function findById($id, $formatter){
			return $formatter->format($this->repository->findById($id));
		}

		public function listAll($formatter){
			return $formatter->format($this->repository->listAll());
		}

		public function delete($id){
			$this->repository->delete($id);
		}


	}


}



?>