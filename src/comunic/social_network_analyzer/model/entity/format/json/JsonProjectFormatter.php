<?php

namespace comunic\social_network_analyzer\model\entity\format\json{

	use comunic\social_network_analyzer\model\entity\mappers\ProjectToArray;

	class JsonProjectFormatter extends BasicObjectFormatter{

		protected function toMap($obj){

			$fProjectToArray = new ProjectToArray();
			$dados=$fProjectToArray($obj);


			return $dados;
		}


	}

}


?>