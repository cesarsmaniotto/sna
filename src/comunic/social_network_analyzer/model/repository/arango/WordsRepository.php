<?php

namespace comunic\social_network_analyzer\model\repository\arango{

	use comunic\social_network_analyzer\model\util\StringUtil;
	use comunic\social_network_analyzer\model\util\ArrayUtil;
	use comunic\social_network_analyzer\model\entity\Word;
	use comunic\social_network_analyzer\model\entity\mappers\WordToArray;
	use comunic\social_network_analyzer\model\entity\mappers\ArrayToWord;

	class WordsRepository extends AbstractArangoRepository {
		
		function __construct(){
			parent::__construct();

			$this->entityName = "words";

		}

		public function importFromTweet($tweets){

			$edges = array();
			$words = array();
			$id = 0;
			foreach ($tweets as $tweet) {
				$textWithoutPunctuation = StringUtil::removePunctuation($tweet->getText(),"_-");
				$wordsTw = ArrayUtil::eliminates_repeated(\explode(" ", $textWithoutPunctuation));

				$tweetIdArango = $this->buildId("tweets",$tweet->getId());
				$wordIdArango ="";

				foreach($wordsTw as $word){

					if(!isset($words[$word])){
						$wordObj = new Word($id++,$word);
						$words[$word]= $wordObj;
						$wordIdArango = $this->buildId("words",$wordObj->getId());
					}else{
						$wordIdArango = $this->buildId("words",$words[$word]->getId());
					}
					
					$edges[] = $this->graphHandler->createEdge($tweetIdArango,$wordIdArango,"tweets_words_contains");

				}

				
			}
			$this->graphHandler->importObjects("words",\array_values($words),new WordToArray());

			$slicer = ArrayUtil::slicer($edges,20000);

			foreach ($slicer as $slice) {
				$this->graphHandler->import("tweets_words_contains",$slice);
			}
			



			// $textWithoutPunctuation = StringUtil::removePunctuation($tweet->getText());
			// $words = ArrayUtil::eliminates_repeated(\explode(" ", $textWithoutPunctuation));
			
			// $wordObjects=array();

			// foreach($words as $word){
			// 	$wordObjects[]= new Word($word);
			// }

			// $this->graphHandler->importObjects("words",$wordObjects,new WordToArray());

			// $edges = array();
			// $tweetIdArango = $this->buildId("tweets",$tweet->getId());
			// foreach ($wordObjects as $word) {
				
			// 	$wordIdArango = $this->buildId("words",$word->getId());
			// 	$edges[] = $this->graphHandler->createEdge($tweetIdArango,$wordIdArango,"tweets_words_contains",array("_key"=>$tweet->getId().$word->getId()));
			// }

			// $this->graphHandler->import("tweets_words_contains",$edges);
		}

		public function getWordsAsString(){
			$words = $this->graphHandler->listVertex($this->entityName,new ArrayToWord());
			$strWords = array();

			foreach ($words as $word) {
				$strWords[]=$word->getWord();
			}

			return $strWords;
		}

		public function listAll(){
			return $this->graphHandler->listVertex($this->entityName,new ArrayToWord());
		}

		

	}

	


}

?>