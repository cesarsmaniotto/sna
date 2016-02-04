<?php

namespace comunic\social_network_analyzer\model\entity\mappers{

	use comunic\social_network_analyzer\model\entity\Project;

	class ArrayToProject{

		public function __invoke($arrayData){

			$project = new Project();

			if(isset($arrayData['id'])){
				$project->setId($arrayData['id']);
			}

			if(isset($arrayData['name'])){
				$project->setName($arrayData['name']);
			}

			if(isset($arrayData['datasets'])){

				$datasets = array();

				foreach ($arrayData['datasets'] as $dataset) {
					$datasets[] = new ArrayToDataset($dataset);
				}

				$project->setDatasets($datasets);

			}

			return $project;
		}

	}

}


?>