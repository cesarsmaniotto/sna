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
            
        }

        public function listAll() {

            return $this->mongoch->find(new ArrayToTweet());
        }

        public function findById($id) {

            return $this->mongoch->findOne(new ArrayToTweet(), array('_id' => new \MongoId($id)));
        }

<<<<<<< HEAD
        public function listByCategory($keywords) {

            return $this->mongoch->find(array('text' => array('$in' => $keywords)));
=======
        public function listByCategory($category){

            return $this->mongoch->find(new ArrayToTweet(), array('text' => array('$in' => $category->getKeywords())));

>>>>>>> inclusao de findByCategory no index
        }

    }

}



?>