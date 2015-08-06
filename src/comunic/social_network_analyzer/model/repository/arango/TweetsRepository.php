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
			$this->collHandler->setCollection($this->entityName);

		}

		public function insert($tweets, $datasetId){
			
			$idsTweets = $this->graphHandler->importDocuments($tweets, $this->entityName,new TweetToArray());
			$datasetId = $this->mountId("datasets",$datasetId);
			
			$this->graphHandler->createEdgeToManyFrom($datasetId,$idsTweets,"datasets_tweets_belong");

			$tweets = $this->graphHandler->getByIds($idsTweets, $this->entityName, new ArrayToTweet());

			foreach ($tweets as $tweet) {
				$textWithoutPunctuation = StringUtil::removePunctuation($tweet->getText());
				$words = ArrayUtil::eliminates_repeated(\explode(" ", $textWithoutPunctuation));
				$tweetId = $this->mountId($this->entityName, $tweet->getId());	
				$wordObjects=array();
				$wordIds=array();
				foreach($words as $word){
					$wordObj=new Word($word);
					$wordId=$this->mountId("words",$wordObj->getId());
					$wordIds[]=$wordId;
					$wordObjects[$wordId]= $wordObj;
				}
				$existingIds = $this->graphHandler->returnsExistingIds($wordIds,"words");

				foreach ($existingIds as $id) {
					unset($wordObjects[$id]);
				}

				$this->graphHandler->importDocuments(array_values($wordObjects),"words",new WordToArray());

				$this->graphHandler->createEdgeToManyFrom($tweetId,$wordIds,"tweets_words_contains");

			}
			
		}

		public function listAll(){

			return $this->graphHandler->listVertex($this->entityName,new ArrayToTweet());
		}

		public function filterByDataset($datasetId){
			$datasetId = $this->mountId("datasets", $datasetId);

			$edges = $this->graphHandler->getConnectedEdges($datasetId,"projects_datasets_has");

			$datasets = array();
			foreach ($edges->getAll() as $edge) {
				$datasets[] = $this->graphHandler->getVertex($edge->getTo() ,new ArrayToTweet());
			}

			return $datasets;
		}

		public function findById($id){
			$id = $this->mountId($this->entityName, $id);
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
			$words = $this->graphHandler->listVertex("words",new ArrayToWord());
			$strWords = array();

			foreach ($words as $word) {
				$strWords[]=$word->getWord();
			}
			$kwAsRegex=$category->toRegex();

			$matchWords = array();
			foreach ($kwAsRegex as $kw) {
				$matchWords = \array_merge($matchWords, preg_grep($kw, $strWords));
			}

			$wordsIds = array();
			foreach ($matchWords as $word) {
				$wordsIds[] = array("_id" => $this->mountId("words", new Word($word)));
			}

			$neighbors = $this->graphHandler->getCommonNeighbors(array("_id"=>$this->mountId("datasets", $datasetId)), $wordsIds);

			return $this->graphHandler->getByIds($neighbors,$this->entityName,new ArrayToTweet());
		}


		public function listInAnInterval($datasetId, $skip, $amount){
			$datasetId = $this->mountId("datasets", $datasetId);

			$edges = $this->graphHandler->getConnectedEdges($datasetId, "datasets_tweets_belong");
			
			$tweetsIds = array();
			foreach ($edges->getAll() as $edge) {
				$tweetsIds[] =$edge->getFrom();
			}

			return $this->graphHandler->getByIdsInAnInterval($tweetsIds,$this->entityName,new ArrayToTweet(),$skip, $amount);

		}

		public function findbyCategoryInAnInterval($datasetId, $category, $skip, $amount){

			$words = $this->graphHandler->listVertex("words",new ArrayToWord());
			$strWords = array();

			foreach ($words as $word) {
				$strWords[]=$word->getWord();
			}

			$kwAsRegex=$category->toRegex();

			$matchWords = array();
			foreach ($kwAsRegex as $kw) {
				$matchWords = \array_merge($matchWords, preg_grep($kw, $strWords));
			}
			$wordsIds = array();
			foreach ($matchWords as $word) {
				$wordsIds[] = array("_id" => $this->mountId("words", new Word($word)));
			}

			$neighbors = $this->graphHandler->getCommonNeighbors(array("_id"=>$this->mountId("datasets", $datasetId)), $wordsIds);

			return $this->graphHandler->getByIdsInAnInterval($neighbors,$this->entityName,new ArrayToTweet(),$skip, $amount);

		}

	}

	


}

?>