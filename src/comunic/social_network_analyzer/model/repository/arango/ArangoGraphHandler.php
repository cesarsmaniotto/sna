<?php

namespace comunic\social_network_analyzer\model\repository\arango{

	require "vendor/autoload.php";

	use triagens\ArangoDb\GraphHandler;
	use triagens\ArangoDb\Edge;
	use triagens\ArangoDb\Cursor;
	use triagens\ArangoDb\Vertex;
	use triagens\ArangoDb\Graph;
	use triagens\ArangoDb\EdgeDefinition;
	use triagens\ArangoDb\Statement;
	use triagens\ArangoDb\Urls;
	use triagens\ArangoDb\UrlHelper;
	use comunic\social_network_analyzer\model\repository\arango\mappers\ArrayWithArangoKeyToObject;
	use comunic\social_network_analyzer\model\repository\arango\mappers\ObjectToArrayWithArangoKey;
	use comunic\social_network_analyzer\model\util\ArrayUtil;
	use comunic\social_network_analyzer\model\entity\Paginator;

	class ArangoGraphHandler{

		private $graphHandler;
		private $graph;
		private $connection;

		function __construct(){
			$conn = new ConnectionArango();
			$this->connection = $conn->getConnection();

			$this->graphHandler = new GraphHandler($this->connection);

			try {

				/*
				TODO criar arquivo com arrays e constantes de configuração

				*/

				$this->graphHandler->createGraph(new Graph("sna"));
				$this->setGraph("sna");
				$this->addEdgeDefinition("projects_datasets_has","projects","datasets");
				$this->addEdgeDefinition("datasets_tweets_belong","datasets","tweets");
				$this->addEdgeDefinition("tweets_categories_belong","tweets","categories");
				$this->addEdgeDefinition("tweets_categories_not_belong","tweets","categories");
				$this->addEdgeDefinition("tweets_words_contains","tweets","words");
		
			} catch (\Exception $e) {

			}
			$this->setGraph("sna");
		
		}

		public function importObjects($collection,$objects,$toArrayFunc){

			$fObjectToArray = new ObjectToArrayWithArangoKey();	

			$arrayData = array();
			foreach ($objects as $obj) {
				$arrayData[] = $fObjectToArray($obj, $toArrayFunc);
			}

			return $this->import($collection,$arrayData);

		}

		public function import($collection, $arrayData){
			$params = array(
				"type"=>"list",
				"collection"=>$collection,
				"createCollection"=>false,
				"overwrite"=>false,
				"waitForSync"=>false,
				"onDuplicate"=>"ignore",
				"complete"=>false,
				"details"=>true);

			$url      = UrlHelper::appendParamsUrl(Urls::URL_IMPORT, $params);
			
			$response = $this->connection->post($url, $this->connection->json_encode_wrapper($arrayData));

			// echo var_dump($response->getJson());

		}




		public function setGraph($graphName){
			$this->graph = $this->graphHandler->getGraph($graphName);
		}

		public function addEdgeDefinition($relationName, $colFromName, $colToName){
			$this->graphHandler->addEdgeDefinition($this->graph, new EdgeDefinition($relationName, $colFromName, $colToName));
		}

		public function createVertex($obj, $toArrayDataFunction, $collection=null){
			$fObjectToArray = new ObjectToArrayWithArangoKey();

			$arrayData = $fObjectToArray($obj, $toArrayDataFunction);

			return $this->graphHandler->saveVertex($this->graph, $arrayData, $collection);
		}

		public function deleteVertex($vertexId, $revision = null, $options = array(), $collection = null){
			return $this->graphHandler->removeVertex($this->graph, $vertexId, $revision, $options, $collection);
		}

		public function getVertex($vertexId, $toObjectFunction, array $options = array(), $collection = null){
			$arrayData = $this->graphHandler->getVertex($this->graph, $vertexId, $options, $collection)->getAll();
			return $this->createObject($arrayData, $toObjectFunction);

		}

		public function hasVertex($vertexId){
			return $this->graphHandler->hasVertex($this->graph, $vertexId);
		}

		public function updateVertex($vertexId, $obj, $toArrayDataFunction, $options = array(), $collection = null){
			$fObjectToArray = new ObjectToArrayWithArangoKey();

			$arrayData = $fObjectToArray($obj, $toArrayDataFunction);
			$documentVertex = Vertex::createFromArray($arrayData);

			return $this->graphHandler->updateVertex($this->graph, $vertexId, $documentVertex, $options, $collection);
		}

		public function saveEdge($fromVertex, $toVertex, $collectionEdge = null, $labelEdge = null, $documentEdge = array()){
			return $this->graphHandler->saveEdge($this->graph, $fromVertex, $toVertex, $labelEdge, $documentEdge, $collectionEdge);
		}

		public function createEdge($fromVertex, $toVertex, $label=null,$document=array()){

			if (is_array($document)) {
			    $document = Edge::createFromArray($document);
			}
			if (!is_null($label)) {
			    $document->set('$label', $label);
			}
			$document->setFrom($fromVertex);
			$document->setTo($toVertex);
			$data = $document->getAll();
			$data["_from"] = $fromVertex;
			$data["_to"] = $toVertex;

			return $data;
		}

		public function getEdge($edgeId, array $options = array(), $collection = null){
			return $this->graphHandler->getEdge($this->graph, $edgeId, $options, $collection);
		}

		public function hasEdge($edgeId){
			return $this->graphHandler->hasEdge($this->graph, $edgeId);
		}

		public function updateEdge($edgeId, $label, $arrayData, $options = array(), $collection = null){
			$document = Edge::createFromArray($arrayData);

			return $this->graphHandler->updateEdge($this->graph, $edgeId, $label, $document, $options = array(), $collection = null);
		}

		public function deleteEdge($edgeId, $revision = null, $options = array(), $collection = null){
			return $this->graphHandler->removeEdge($this->graph, $edgeId, $revision = null, $options = array(), $collection = null);
		}

		public function getEdges($vertexId, $edgeCollection){
			return $this->graphHandler->getEdges($this->graph, array('vertexExample'=> $vertexId, 'edgeCollectionRestriction'=>$edgeCollection));
		}

		public function getEdgesWithVertices($vertexId,$edgeCollection,$toObjectFunc,$params,$orientation='any',$edgeExample=null){
			// $params['vertexId']=$vertexId;
			// $params['@edgeCollection']=$edgeCollection;
			// $params['orientation']=$orientation;
			// $params['edgeExample']=$edgeExample;

			// $params['option']=array('includeVertices'=>true);

			// $cursor = $this->executeStatement("FOR e in EDGES(@@edgeCollection,@vertexId,@orientation,@edgeExample,@option) SORT e.vertex.@sortBy @direction LIMIT @skip,@amount RETURN e",
			// $params,true);

			// $result = $cursor->getAll();

			// $objects = array();
			// foreach ($cursor as $item) {
			// 	$objects[]=$this->createObject($item->vertex, $toObjectFunc);
			// }
			// return new Paginator($objects, $cursor->getFullCount(), $params['skip'],$params['amount']);

			$params['vertexId']=$vertexId;
			$params['graph']="sna";
			$params['@edgeCollection']=$edgeCollection;
			// $params['orientation']=$orientation;

			// $params['option']=array('includeVertices'=>true);

			$cursor = $this->executeStatement("for e in graph_edges(@graph,@vertexId,{edgeCollectionRestriction:@@edgeCollection,includeData:true}) return (for u in tweets filter e._to == u._id sort u.@sortBy @direction limit @skip,@amount return u )"
				,$params,true);

			$objects = $this->createObject($cursor->getAll(), $toObjectFunction);

			return new Paginator($objects, $cursor->getFullCount(), $skip, $amount);
		}

		public function executeStatement($query, $params, $fullCount=false){

			$stmt = new Statement($this->connection, array('query' => $query, 'bindVars' => $params, 'fullCount' => $fullCount));

			return $stmt->execute();

		}

		private function createObject($arrayData, $toObjectFunction){

			$fArrayToObject = new ArrayWithArangoKeyToObject();	
			

			if(ArrayUtil::is_assoc_array($arrayData)){
				return $fArrayToObject($arrayData, $toObjectFunction);
			}else{
				$objects = array();
				foreach($arrayData as $item){
					$objects[]= $fArrayToObject($item->getAll(), $toObjectFunction);
				}
				return $objects;
			}	

		}

		public function listVertex($collectionName,$toObjectFunction){
			$options['@collection'] = $collectionName;
			$cursor = $this->executeStatement("FOR u in @@collection RETURN u", 
				$options,true);

			if($cursor->getCount()==0){
				return [];
			}

			return $this->createObject($cursor->getAll(),$toObjectFunction);
		}

		public function listInAnInterval($collectionName, $toObjectFunction, $options){
			$options['@collection'] = $collectionName;
			$cursor = $this->executeStatement("FOR u in @@collection SORT u.@sortBy @direction LIMIT @skip,@amount RETURN u",
				$options, true);

			$objects = $this->createObject($cursor->getAll(), $toObjectFunction);

			return new Paginator($objects, $cursor->getFullCount(), $options['skip'], $options['amount']);

		}

		public function getByIds($idList,$collectionName,$toObjectFunction,$options){
			$options['@collection'] = $collectionName;
			$options['idList']=$idList;
			$cursor = $this->executeStatement("FOR u in @idList FOR v in @@collection FILTER u == v._id SORT v.@sortBy @direction RETURN v",
				$options,true);

			if($cursor->getCount()==0){
				return [];
			}

			return $this->createObject($cursor->getAll(), $toObjectFunction);	
		}

		public function getByIdsInAnInterval($idList,$collectionName,$toObjectFunction,$options){
			$options['@collection'] = $collectionName;
			$options['idList'] = $idList;
			$cursor = $this->executeStatement("FOR u in @idList FOR v in @@collection FILTER u == v._id SORT v.@sortBy @direction LIMIT @skip,@amount RETURN v",
				$options,true);

			$objects = $this->createObject($cursor->getAll(), $toObjectFunction);

			return new Paginator($objects, $cursor->getFullCount(), $options['skip'], $options['amount']);
		}

		public function queryLikeInAnInterval($collection,$attrib, $search, $toObjectFunc, $options){

			$options['@collection']=$collection;
			$options['attrib']=$attrib;
			$options['search']="%$search%";

			$cursor = $this->executeStatement("FOR u in @@collection FILTER LIKE(u.@attrib,@search,true) SORT u.@sortBy @direction LIMIT @skip,@amount RETURN u",$options,true);
			$objects = $this->createObject($cursor->getAll(), $toObjectFunc);
			return new Paginator($objects, $cursor->getFullCount(), $options['skip'], $options['amount']);


		}

		public function queryLike($collection,$attrib, $search, $toObjectFunc, $options){

			$options['@collection']=$collection;
			$options['attrib']=$attrib;
			$options['search']="%$search%";

			$cursor = $this->executeStatement("FOR u in @@collection FILTER LIKE(u.@attrib,@search,true) SORT u.@sortBy @direction RETURN u",$options);
			return $this->createObject($cursor->getAll(), $toObjectFunc);



		}

		public function getCommonNeighbors($vertex1, $vertex2, $options1=array(), $options2=array()){
			$params = array(
				"graph" => "sna",
				"vertex1" => $vertex1,
				"vertex2" => $vertex2,
				"options1" => $options1,
				"options2" => $options2
				);

			$cursor = $this->executeStatement("FOR e IN GRAPH_COMMON_NEIGHBORS(@graph, @vertex1,@vertex2,@options1,@options2) RETURN e.neighbors", $params);
		
			$neighbors=array();

			foreach ($cursor->getAll() as $item) {

				$neighbors = \array_merge($neighbors,$item->getAll());

			}
			return ArrayUtil::eliminates_repeated($neighbors);

		}

		// public function importDocuments($objects, $collectionName,$toArrayFunc){

		// 	$fObjectToArray = new ObjectToArrayWithArangoKey();	

		// 	$arrayData = array();
		// 	foreach ($objects as $obj) {
		// 		$arrayData[] = $fObjectToArray($obj, $toArrayFunc);
		// 	}


		// 	$query = "FOR u in @arrayData INSERT u IN @@collection RETURN NEW._id";
		// 	$params = array('arrayData'=>$arrayData, '@collection'=>$collectionName);

		// 	$cursor = $this->executeStatement($query,$params);

		// 	return $cursor->getAll();

		// }

		// public function returnsExistingIds($idsList,$collectionName){

		// 	$query = "FOR u in @idsList FOR v in @@collection FILTER u == v._id RETURN u";
		// 	$params = array('idsList'=>$idsList, '@collection'=>$collectionName);

		// 	return $this->executeStatement($query,$params)->getAll();

		// }

		// public function createEdgeToManyFrom($to,$listFrom,$edgeCollection){
		// 	$query = "FOR u in @listFrom 
		// 				INSERT {
		// 					_to: @to,
		// 					_from: u
		// 				} 
		// 				IN @@collection 
		// 				RETURN NEW";
		// 	$params = array('to'=>$to,'listFrom'=>$listFrom, '@collection'=>$edgeCollection);

		// 	$cursor = $this->executeStatement($query,$params);

		// 	return $cursor->getAll();

		// }

	}

}

?>