<?php

namespace comunic\social_network_analyzer\model\repository\mongo {

    use \comunic\social_network_analyzer\model\repository\mongo\MongoCollectionHandler;
    use \comunic\social_network_analyzer\model\repository\ITweetsRepository;
    use \comunic\social_network_analyzer\model\entity\mappers\ArrayToTweet;
    use comunic\social_network_analyzer\model\entity\mappers\TweetToArray;

    class TweetsRepository implements ITweetsRepository {

        private $mongoch;

        function __construct() {
            $this->mongoch = new MongoCollectionHandler('tweets');
        }

        public function insert($tweet) {

            return $this->mongoch->save($tweet ,new TweetToArray());

        }

        public function listAll() {

            return $this->mongoch->find(new ArrayToTweet());
        }

        public function listInAnInterval($initial, $final){
            return $this->mongoch->findInAnInterval($initial, $final, new ArrayToTweet());
        }

        public function findById($id) {

            return $this->mongoch->findOne(new ArrayToTweet(), array('_id' => new \MongoId($id)));
        }

        private function filterByCategory($category){
            $keywords = $category->getKeywords();
            $keywordsAsRegex = array();

            foreach ($keywords as $keyword) {
                $keywordsAsRegex[] = new \MongoRegex('/'.$keyword.'/');
            }

            return $keywordsAsRegex;
        }

        public function findByCategory($category) {

            return $this->mongoch->find(new ArrayToTweet(), array('text' => array('$in' => $this->filterByCategory($category))));

        }

        public function findbyCategoryInAnInterval($category, $initial, $final){

            return $this->mongoch->findInAnInterval($initial, $final, new ArrayToTweet(), array('text' => array('$in' => $this->filterByCategory($category))));

        }



    }

}



?>