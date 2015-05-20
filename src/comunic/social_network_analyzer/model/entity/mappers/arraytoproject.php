<?php

namespace comunic\social_network_analyzer\model\entity\mappers{

	use comunic\social_network_analyzer\model\Project;

	class ArrayToProject{

		public function __invoke($arrayData){

			$project = new Project();

			if(isset($arrayData['_id']->{'$id'})){
				$project->setId($arrayData['_id']->{'$id'});
			}

			if(isset($arrayData['name'])){
				$project->setName($arrayData['name']);
			}

			if(isset($arrayData['datasets'])){
				$project->setDatasets($arrayData['datasets']);
			}

			return $project;
		}

	}

}


?>