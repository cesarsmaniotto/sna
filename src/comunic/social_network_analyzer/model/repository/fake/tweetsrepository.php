<?php

namespace comunic\social_network_analyzer\model\repository\fake {

    use comunic\social_network_analyzer\model\repository\ITweetsRepository;

    /**
     * Description of tweetsrepository
     *
     * @author jean
     */
    class TweetsRepository extends DiskRepository implements ITweetsRepository {

        

        function __construct() {
            parent::__construct('tweets');
        }

 
        public function listByCategory($category) {
            
            return $this->listAll();
            
        }

    }

}