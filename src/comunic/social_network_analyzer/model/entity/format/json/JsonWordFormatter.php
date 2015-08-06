<?php

namespace comunic\social_network_analyzer\model\entity\format\json{

	use comunic\social_network_analyzer\model\entity\mappers\WordToArray;

	class JsonWordFormatter extends BasicObjectFormatter{

		protected function toMap($obj){

			$fWordToArray = new WordToArray();
			$dados=$fWordToArray($obj);


			return $dados;
		}


	}

}


?>