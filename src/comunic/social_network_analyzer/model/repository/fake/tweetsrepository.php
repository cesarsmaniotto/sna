<?php

namespace comunic\social_network_analyzer\model\repository\fake {

    use comunic\social_network_analyzer\model\repository\ITweetsRepository;
    

    /**
     * Description of tweetsrepository
     *
     * @author jean
     */
    class TweetsRepository implements ITweetsRepository {

        static private $DADOS = array();

        public function findById($id) {

            \array_key_exists($id, TweetsRepository::$DADOS);

            if (\array_key_exists($id, TweetsRepository::$DADOS)) {
                return TweetsRepository::$DADOS[$id];
            }

            throw new \Exception("Nao existe entidade com id = $id");
        }

        public function insert($tweet) {
            TweetsRepository::$DADOS[] = $tweet;
        }

        public function listAll() {
            return TweetsRepository::$DADOS;
        }

        public function listByCategory($category) {
            return $this->listAll();
        }

    }

}