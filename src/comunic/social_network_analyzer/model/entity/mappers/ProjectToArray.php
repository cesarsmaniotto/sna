<?php

namespace comunic\social_network_analyzer\model\entity\mappers{

	use comunic\social_network_analyzer\model\entity\mappers\DatasetToArray;
	use comunic\social_network_analyzer\model\entity\mappers\CategoryToArray;

	class ProjectToArray{

		public function __invoke($obj){

			$datasets = array();

			if(!\is_null($obj->getDatasets())){
				foreach ($obj->getDatasets() as $dataset) {
					$toArray = new DatasetToArray();
					$datasets[] = $toArray($dataset);
				}
			}

			$categories = array();

			if(!\is_null($obj->getCategories())){
				foreach ($obj->getCategories() as $category) {
					$toArray = new CategoryToArray();
					$categories[] = $toArray($category);
				}
			}		

			return array(
				'id' => $obj->getId(),
				'name' => $obj->getName(),
                'datasets' => $datasets,
                'categories' => $categories
                );



		}


	}


}


?>