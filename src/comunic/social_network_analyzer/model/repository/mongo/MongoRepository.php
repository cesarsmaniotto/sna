<?php


namespace comunic\social_network_analyzer\model\repository\mongo{

    use comunic\social_network_analyzer\model\repository\IRepositoryFactory;

    class MongoRepository implements IRepositoryFactory{

        public function instantiateCategory() {
            return new CategoriesRepository();
        }

        public function instantiateTweet() {
            return new TweetsRepository();
        }

        public function instantiateUser() {
            return new UsersRepository();
        }

        public function instantiateProject() {
            return new ProjectsRepository();
        }



    }




}


?>