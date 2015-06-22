<?php

namespace comunic\social_network_analyzer\model\entity\mappers{

	class ProjectToArray{

		public function __invoke($obj){

                                $fDatasetToArray = new DatasetToArray();

			$arrayData = array(
				'_id' => new \MongoId($obj->getId()),
				'name' => $obj->getName()
                                            );

                                $datasets = array();

                                foreach ($obj->getDatasets() as $dataset) {
                                    $datasets[] = $fDatasetToArray($dataset);
                                }

                                $arrayData['datasets']=$datasets;
                                return $arrayData;

		}


	}


}


?>