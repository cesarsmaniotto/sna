<?php

namespace comunic\social_network_analyzer\model\entity\mappers{

	use comunic\social_network_analyzer\model\entity\Project;

	class ArrayToProject{

		public function __invoke($arrayData){

			$project = new Project();
			$fArrayToDataset = new ArrayToDataset();

			if(isset($arrayData['_id']->{'$id'})){
				$project->setId($arrayData['_id']->{'$id'});
			}

			if(isset($arrayData['name'])){
				$project->setName($arrayData['name']);
			}

			if(isset($arrayData['datasets'])){
				$datasets = array();
				foreach ($arrayData['datasets'] as $dataset) {
					$datasets[]=$fArrayToDataset($dataset);
				}

				$project->setDatasets($datasets);
			}


			return $project;
		}

	}

}


?>