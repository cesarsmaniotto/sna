<?php

namespace comunic\social_network_analyzer\model\repository\arango{

	require "vendor/autoload.php";

	use triagens\ArangoDb\CollectionHandler;

	use comunic\social_network_analyzer\model\repository\arango\mappers\ArrayWithArangoKeyToObject;
	use comunic\social_network_analyzer\model\repository\arango\mappers\ObjectToArrayWithArangoKey;

	class ArangoCollectionHandler{

		protected $collHandler;
		protected $collection;

		function __construct(){
			$conn = new ConnectionArango();
			$connection = $conn->getConnection();

			$this->collHandler = new CollectionHandler($connection);
			
		}

		public function setCollection($collectionName){
			$this->collection = $collectionName;
		}

		public function listDocuments($toObjectFunction, $options = array()){

			$data = $this->collHandler->all($this->collection, $options = array());
			$data = $data->getAll();

			$arrayObjects = array();
			$fArrayToObject = new ArrayWithArangoKeyToObject();
	
			foreach ($data as $item) {
				$arrayObjects[] = $fArrayToObject($item->getAll(), $toObjectFunction);
			}

			return $arrayObjects;
		}

		
	}

}

?>