<?php
namespace comunic\social_network_analyzer\model\facade {

  

    /**
     * class FacadeFactory
     *
     */
    class FacadeFactory {

        private $repositoryFactory;

        /**
         * @param \comunic\social_network_analyzer\model\repository\IRepositoryFactory $repositoryFactory
         *
         *  */

        public function __construct($repositoryFactory) {
            $this->repositoryFactory = $repositoryFactory;
        }

        /**
         *
         *
         * @return \comunic\social_network_analyzer\model\facade\TweetsFacade
         * @access public
         */
        public function instantiateTweets() {
            return new TweetsFacade($this->repositoryFactory->instantiateTweet());
        }

// end of member function instantiateTweets

        /**
         *
         *
         * @return \comunic\social_network_analyzer\model\facade\CategoriesFacade
         * @access public
         */
        public function instantiateCategories() {
            return new CategoriesFacade($this->repositoryFactory->instantiateCategory());
        }

// end of member function instantiateCategories

        /**
         *
         *
         * @return \comunic\social_network_analyzer\model\facade\UsersFacade
         * @access public
         */
        public function instantiateUsers() {
            return new UsersFacade($this->repositoryFactory->instantiateUser());
        }

// end of member function instantiateUsers
    }

} // end of FacadeFactory
?>
