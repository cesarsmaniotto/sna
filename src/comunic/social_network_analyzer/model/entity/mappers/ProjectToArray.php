<?php

namespace comunic\social_network_analyzer\model\entity\mappers{

	class ProjectToArray{

		public function __invoke($obj){

			$datasets = array();

			foreach ($obj->getDatasets() as $dataset) {
				$datasets[] = new DatasetToArray($dataset);
			}

			return array(
				'id' => $obj->getId(),
				'name' => $obj->getName(),
				'datasets' => $datasets
                );



		}


	}


}


?>