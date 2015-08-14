<?php

namespace comunic\social_network_analyzer\model\util\idBuilder{

	class IdArangoBuilder{


		public function __invoke($entityName, $id){
			return "$entityName/$id";
		}

	}

}


?>