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

		public function importFromTweet($tweet){
			$textWithoutPunctuation = StringUtil::removePunctuation($tweet->getText());
			$words = ArrayUtil::eliminates_repeated(\explode(" ", $textWithoutPunctuation));
			
			$wordObjects=array();

			foreach($words as $word){
				$wordObjects[]= new Word($word);
			}

			$this->graphHandler->importObjects("words",$wordObjects,new WordToArray());

			$edges = array();
			$tweetIdArango = $this->buildId("tweets",$tweet->getId());
			foreach ($wordObjects as $word) {
				
				$wordIdArango = $this->buildId("words",$word->getId());
				$edges[] = $this->graphHandler->createEdge($tweetIdArango,$wordIdArango,"tweets_words_contains",array("_key"=>$tweet->getId().$word->getId()));
			}

			$this->graphHandler->import("tweets_words_contains",$edges);
		}

		public function getWordsAsString(){
			$words = $this->graphHandler->listVertex($this->entityName,new ArrayToWord(),array());
			$strWords = array();

			foreach ($words as $word) {
				$strWords[]=$word->getWord();
			}

			return $strWords;
		}

		

	}

	


}

?>