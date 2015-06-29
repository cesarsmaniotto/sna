<?php


namespace comunic\social_network_analyzer\model\repository\mongo{

    use comunic\social_network_analyzer\model\repository\IRepositoryFactory;

    class MongoRepository implements IRepositoryFactory{

        private $connectionType;

        public function __construct($connectionType){
            $this->connectionType = $connectionType;
        }

        public function instantiateCategory() {
            return new CategoriesRepository($this->connectionType);
        }

        public function instantiateTweet() {
            return new TweetsRepository($this->connectionType);
        }

        public function instantiateUser() {
            return new UsersRepository($this->connectionType);
        }

        public function instantiateProject() {
            return new ProjectsRepository($this->connectionType);
        }

        public function instantiateDataset() {
            return new DatasetsRepository($this->connectionType);
        }



    }




}


?>