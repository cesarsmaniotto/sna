<?php


namespace comunic\social_network_analyzer\model\facade\mongo{


	class BasicFacade{

		private $repository;


		function __construct($repository){
			$this->repository = $repository;
		}

		public function insert($obj_json, $parser, $auxId = null){
			$obj = $parser->parse($obj_json);
			$this->repository->insert($obj, $auxId);
		}

		public function update($obj_json,$parser, $auxId = null){
			$obj = $parser->parse($obj_json);
			$this->repository->update($obj, $auxId);
		}

		public function findById($id, $formatter, $auxId = null){
			return $formatter->format($this->repository->findById($id,$auxId));
		}

		public function listAll($formatter){
			return $formatter->format($this->repository->listAll());
		}

		public function delete($id, $auxId =null){
			$this->repository->delete($id, $auxId);
		}
		
	}

	}

	?>