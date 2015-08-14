<?php

namespace comunic\social_network_analyzer\model\repository\arango{

	use comunic\social_network_analyzer\model\repository\ITweetsRepository;
	use comunic\social_network_analyzer\model\entity\mappers\ArrayToTweet;
	use comunic\social_network_analyzer\model\entity\mappers\TweetToArray;
	use comunic\social_network_analyzer\model\util\StringUtil;
	use comunic\social_network_analyzer\model\util\ArrayUtil;
	use comunic\social_network_analyzer\model\entity\Word;
	use comunic\social_network_analyzer\model\entity\mappers\WordToArray;
	use comunic\social_network_analyzer\model\entity\mappers\ArrayToWord;

	class TweetsRepository extends AbstractArangoRepository implements ITweetsRepository{
		

		function __construct(){
			parent::__construct();

			$this->entityName = "tweets";
			
		}

		public function import($tweets, $datasetId){
			
			// $idsTweets = $this->graphHandler->importDocuments($tweets, $this->entityName,new TweetToArray());
			$idsTweets = $this->graphHandler->import($this->entityName,$tweets,new TweetToArray());
			// $datasetId = $this->buildId("datasets",$datasetId);
			// $this->graphHandler->createEdgeToManyFrom($datasetId,$idsTweets,"datasets_tweets_belong");

			// $tweets = $this->graphHandler->getByIds($idsTweets, $this->entityName, new ArrayToTweet());
			// $wordsRepo = new WordsRepository();
			// foreach ($tweets as $tweet) {

			// 	$tweetId = $this->buildId($this->entityName, $tweet->getId());	
			// 	$wordsRepo->importFromTweet($tweet->getText(),$tweetId);	

			// }
			
		}

		public function listAll(){

			return $this->graphHandler->listVertex($this->entityName,new ArrayToTweet());
		}

		public function filterByDataset($datasetId){
			$datasetId = $this->buildId("datasets", $datasetId);

			$edges = $this->graphHandler->getConnectedEdges($datasetId,"projects_datasets_has");

			$datasets = array();
			foreach ($edges->getAll() as $edge) {
				$datasets[] = $this->graphHandler->getVertex($edge->getTo() ,new ArrayToTweet());
			}

			return $datasets;
		}

		public function findById($id){
			$id = $this->buildId($this->entityName, $id);
			return $this->graphHandler->getVertex($id, new ArrayToTweet());

		}

		public function addToTheCategory($tweetId, $categoryId){
			return $this->connectTweetWithCategory($tweetId, $categoryId,"tweets_categories_belong");
		}

		public function removeOfCategory($tweetId, $categoryId){
			return $this->connectTweetWithCategory($tweetId, $categoryId,"tweets_categories_not_belong");
		}

		private function connectTweetWithCategory($tweetId, $categoryId, $relationName){
			return $this->graphHandler->createEdge($tweetId,$categoryId,$relationName,$relationName);
		}

		public function findByCategory($datasetId, $category){
			$wordsRepo = new WordsRepository();

			$words = $wordsRepo->getWordsAsString();

			$matchWords = $category->matchWithKeywords($words);

			$wordsIds = array();
			foreach ($matchWords as $word) {
				$wordsIds[] = array("_id" => $this->buildId("words", new Word($word)));
			}

			$neighbors = $this->graphHandler->getCommonNeighbors(array("_id"=>$this->buildId("datasets", $datasetId)), $wordsIds);

			if(\count($neighbors)==0){
				return [];
			}

			return $this->graphHandler->getByIds($neighbors,$this->entityName,new ArrayToTweet());
		}


		public function findbyCategoryInAnInterval($datasetId, $category, $skip, $amount){

			$wordsRepo = new WordsRepository();

			$words = $wordsRepo->getWordsAsString();

			$matchWords = $category->matchWithKeywords($words);

			$wordsIds = array();
			foreach ($matchWords as $word) {
				$wordsIds[] = array("_id" => $this->buildId("words", new Word($word)));
			}

			$neighbors = $this->graphHandler->getCommonNeighbors(array("_id"=>$this->buildId("datasets", $datasetId)), $wordsIds);



			return $this->graphHandler->getByIdsInAnInterval($neighbors,$this->entityName,new ArrayToTweet(),$skip, $amount);

		}

		public function listInAnInterval($datasetId, $skip, $amount){
			$datasetId = $this->buildId("datasets", $datasetId);

			$edges = $this->graphHandler->getConnectedEdges($datasetId, "datasets_tweets_belong");
			
			$tweetsIds = array();
			foreach ($edges->getAll() as $edge) {
				$tweetsIds[] =$edge->getFrom();
			}

			return $this->graphHandler->getByIdsInAnInterval($tweetsIds,$this->entityName,new ArrayToTweet(),$skip, $amount);

		}



	}

	


}

?>