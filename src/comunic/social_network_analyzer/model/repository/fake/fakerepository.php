<?php

namespace comunic\social_network_analyzer\model\repository\fake {

    use comunic\social_network_analyzer\model\repository\IRepositoryFactory;

    /**
     * Description of fakerepository
     *
     * @author jean
     */
    class FakeRepository implements IRepositoryFactory {

        public function instantiateCategory() {
            return new CategoriesRepository();
        }

        public function instantiateTweet() {
            return new TweetsRepository();
        }

        public function instantiateUser() {
            return new UserRepository();
        }

//put your code here
    }

}