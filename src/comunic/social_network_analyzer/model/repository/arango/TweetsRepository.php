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
			$slices = ArrayUtil::slicer($tweets,1000);

			foreach ($slices as $slice) {
				$this->graphHandler->importObjects($this->entityName,$slice,new TweetToArray());

				$edges = array();
				$datasetIdArango = $this->buildId("datasets",$datasetId);
				foreach ($slice as $tweet) {


					$tweetIdArango = $this->buildId($this->entityName,$tweet->getId());
					$edges[] = $this->graphHandler->createEdge($datasetIdArango,$tweetIdArango,"datasets_tweets_belong",array("_key"=>$datasetId.$tweet->getId()));
				}
				$this->graphHandler->import("datasets_tweets_belong",$edges);
			}

			$wordsRepo = new WordsRepository();
			foreach ($tweets as $tweet) {
				
				$wordsRepo->importFromTweet($tweet);	

			}
			
		}

		public function listAll(){
			$options = array(
				'sortBy'=>'time',
				'direction'=>'ASC'
				);
			return $this->graphHandler->listVertex($this->entityName,new ArrayToTweet(),$options);
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


		public function findbyCategoryInAnInterval($datasetId, $category, $options){

			$wordsRepo = new WordsRepository();

			$words = $wordsRepo->getWordsAsString();

			$matchWords = $category->matchWithKeywords($words);

			$wordsIds = array();
			foreach ($matchWords as $word) {
				$wordsIds[] = array("_id" => $this->buildId("words", new Word($word)));
			}

			$neighbors = $this->graphHandler->getCommonNeighbors(array("_id"=>$this->buildId("datasets", $datasetId)), $wordsIds);



			return $this->graphHandler->getByIdsInAnInterval($neighbors,$this->entityName,new ArrayToTweet(),$options);

		}

		public function listInAnInterval($datasetId, $options){
			$datasetId = $this->buildId("datasets", $datasetId);

			$edges = $this->graphHandler->getConnectedEdges($datasetId, "datasets_tweets_belong");
			
			$tweetsIds = array();
			foreach ($edges->getAll() as $edge) {
				$tweetsIds[] =$edge->getTo();
			}

			return $this->graphHandler->getByIdsInAnInterval($tweetsIds,$this->entityName,new ArrayToTweet(),$options);

		}



	}

	


}

?>