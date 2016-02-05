<?php

namespace comunic\social_network_analyzer\model\entity\mappers{

	use comunic\social_network_analyzer\model\entity\Project;
	use comunic\social_network_analyzer\model\entity\mappers\ArrayToDataset;
	use comunic\social_network_analyzer\model\entity\mappers\ArrayToCategory;

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
					$toDataset = new ArrayToDataset();
					$datasets[] = $toDataset($dataset);
				}

				$project->setDatasets($datasets);
			}

			if(isset($arrayData['categories'])){

				$categories = array();

				foreach ($arrayData['categories'] as $category) {
					$toCategory = new ArrayToCategory();
					$categories[] = $toCategory($category);
				}

				$project->setCategories($categories);
			}


			return $project;
		}

	}

}


?>