<?php

namespace comunic\social_network_analyzer\model\entity\format\json{

	use comunic\social_network_analyzer\model\entity\mappers\ProjectToArray;

	class JsonProjectFormatter extends BasicObjectFormatter{

		protected function toMap($obj){

			$fProjectToArray = new ProjectToArray();
			$dados=$fProjectToArray($obj);
			unset($dados['_id']);
			$dados["id"] = $obj->getId();

			for($i=0;$i < \count($dados['datasets']); $i++){

				$dados['datasets'][$i]['id'] = $dados['datasets'][$i]['_id']->{'$id'};
				unset($dados['datasets'][$i]['_id']);

			}


			return $dados;
		}


	}

}


?>