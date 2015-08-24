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
			// $slices = ArrayUtil::slicer($tweets,1000);

			// foreach ($slices as $slice) {
				$this->graphHandler->importObjects($this->entityName,$tweets,new TweetToArray());

				$edges = array();
				$datasetIdArango = $this->buildId("datasets",$datasetId);
				foreach ($tweets as $tweet) {	

					$tweetIdArango = $this->buildId($this->entityName,$tweet->getId());
					$edges[] = $this->graphHandler->createEdge($datasetIdArango,$tweetIdArango,"datasets_tweets_belong",array("_key"=>$datasetId.$tweet->getId()));
					
				}
				$this->graphHandler->import("datasets_tweets_belong",$edges);
			// }

			$wordsRepo = new WordsRepository();
			// foreach ($tweets as $tweet) {
				
			$wordsRepo->importFromTweet($tweets);	

			// }
			
		}

		public function listAll(){
			return $this->graphHandler->listVertex($this->entityName,new ArrayToTweet());
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

		public function findByCategory($datasetId, $category,$options){
			$wordsRepo = new WordsRepository();


			$words = $wordsRepo->listAll();

			$matchWords = $category->matchWithKeywords($words);
			

			$wordsIds = array();
			foreach ($matchWords as $word) {
				$wordsIds[] = array("_id" => $this->buildId("words", $word->getId()));
			}

			$neighbors = $this->graphHandler->getCommonNeighbors(array("_id"=>$this->buildId("datasets", $datasetId)), $wordsIds);

			if(\count($neighbors)==0){
				return [];
			}

			return $this->graphHandler->getByIds($neighbors,$this->entityName,new ArrayToTweet(),$options);
		}


		public function findbyCategoryInAnInterval($datasetId, $category, $options){

			$wordsRepo = new WordsRepository();

			$words = $wordsRepo->listAll();

			$matchWords = $category->matchWithKeywords($words);
			

			$wordsIds = array();
			foreach ($matchWords as $word) {
				$wordsIds[] = array("_id" => $this->buildId("words", $word->getId()));
			}

			$neighbors = $this->graphHandler->getCommonNeighbors(array("_id"=>$this->buildId("datasets", $datasetId)), $wordsIds);

			return $this->graphHandler->getByIdsInAnInterval($neighbors,$this->entityName,new ArrayToTweet(),$options);

		}

		public function listByDataset($datasetId, $options){
			$datasetId = $this->buildId("datasets", $datasetId);

			$edges = $this->graphHandler->getEdges($datasetId, "datasets_tweets_belong");
			
			$tweetsIds = array();
			foreach ($edges->getAll() as $edge) {
				$tweetsIds[] =$edge->getTo();
			}

			return $this->graphHandler->getByIds($tweetsIds,$this->entityName,new ArrayToTweet(),$options);

		}

		public function isolateDialogues($tweets,$skip=null,$amount=null){
			for ($i=0; $i < \count($tweets); $i++) { 
				if(!\strstr($tweets[$i]->getText(), '@')){
					unset($tweets[$i]);
				}
			}
			return $tweets;
		}

		public function searchInTheTextInAnInterval($search,$options){
			return $this->graphHandler->queryLikeInAnInterval($this->entityName,"text", $search, new ArrayToTweet(), $options);
		}

		public function searchInTheText($search,$options){
			return $this->graphHandler->queryLike($this->entityName,"text", $search, new ArrayToTweet(), $options);
		}

		public function listByDatasetInAnInterval($datasetId, $options){
			$datasetId = $this->buildId("datasets", $datasetId);

			$edges = $this->graphHandler->getEdges($datasetId, "datasets_tweets_belong");
			
			$tweetsIds = array();
			foreach ($edges->getAll() as $edge) {
				$tweetsIds[] =$edge->getTo();
			}

			return $this->graphHandler->getByIdsInAnInterval($tweetsIds,$this->entityName,new ArrayToTweet(),$options);

			// $datasetId = $this->buildId("datasets", $datasetId);

			// return $this->graphHandler->getEdgesWithVertices($datasetId,"datasets_tweets_belong",new ArrayToTweet(),$options);

		}



	}

	


}

?>