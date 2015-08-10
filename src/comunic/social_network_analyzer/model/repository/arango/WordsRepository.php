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

		public function importFromTweet($text,$tweetId){
			$textWithoutPunctuation = StringUtil::removePunctuation($text);
			$words = ArrayUtil::eliminates_repeated(\explode(" ", $textWithoutPunctuation));
			
			$wordObjects=array();
			$wordIds=array();
			foreach($words as $word){
				$wordObj=new Word($word);
				$wordId=$this->mountId($this->entityName, $wordObj->getId());
				$wordIds[]=$wordId;
				$wordObjects[$wordId]= $wordObj;
			}
			$existingIds = $this->graphHandler->returnsExistingIds($wordIds,$this->entityName );

			foreach ($existingIds as $id) {
				unset($wordObjects[$id]);
			}

			$this->graphHandler->importDocuments(array_values($wordObjects),"words",new WordToArray());
			$this->graphHandler->createEdgeToManyFrom($tweetId,$wordIds,"tweets_words_contains");
		}

		public function getWordsAsString(){
			$words = $this->graphHandler->listVertex($this->entityName,new ArrayToWord());
			$strWords = array();

			foreach ($words as $word) {
				$strWords[]=$word->getWord();
			}

			return $strWords;
		}

		

	}

	


}

?>