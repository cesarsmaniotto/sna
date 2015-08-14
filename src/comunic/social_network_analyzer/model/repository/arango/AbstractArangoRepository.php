<?php

namespace comunic\social_network_analyzer\model\repository\arango{

	abstract class AbstractArangoRepository{

		protected $entityName;
		protected $graphHandler;

		function __construct(){
			
			$this->graphHandler = new ArangoGraphHandler();

		}

		protected function buildId($collName,$objId){
			return "$collName/$objId";
		}

	}

}


?>