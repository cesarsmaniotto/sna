<?php

namespace comunic\social_network_analyzer\model\entity\mappers{

	use comunic\social_network_analyzer\model\entity\Dataset;

	class ArrayToDataset{

		function __invoke($arrayData){

			$dataset = new Dataset();

			if(isset($arrayData['id'])){
				$dataset->setId($arrayData['id']);
			}

			if(isset($arrayData['name'])){
				$dataset->setName($arrayData['name']);
			}

			if(isset($arrayData['hasTweets'])){
				$dataset->setHasTweets($arrayData['hasTweets']);
			}

			return $dataset;

		}

	}

}

?>