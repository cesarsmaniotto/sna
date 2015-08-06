<?php

namespace comunic\social_network_analyzer\model\repository\arango{

	abstract class AbstractArangoRepository{

		protected $entityName;
		protected $graphHandler;
		protected $collHandler;

		function __construct(){
			
			$this->graphHandler = new ArangoGraphHandler();
			$this->collHandler = new ArangoCollectionHandler();
		}

		protected function mountId($collName,$objId){
			return $collName."/".$objId;
		}

	}

}


?>