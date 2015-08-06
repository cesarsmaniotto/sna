<?php

namespace comunic\social_network_analyzer\model\entity\mappers{

	class ProjectToArray{

		public function __invoke($obj){

			return array(
				'id' => $obj->getId(),
				'name' => $obj->getName(),
                'datasetsIds' => $obj->getDatasetsIds()
                );



		}


	}


}


?>