<?php
namespace comunic\social_network_analyzer\model\facade {

    use \comunic\social_network_analyzer\model\facade\TweetsFacade;
    use \comunic\social_network_analyzer\model\facade\CategoriesFacade;
    use \comunic\social_network_analyzer\model\facade\UsersFacade;

    /**
     * class FacadeFactory
     *
     */
    class FacadeFactory {

        private $repositoryFactory;

        /*
         * @param \comunic\social_network_analyzer\model\repository\IRepositoryFactory $repositoryFactory
         *
         *  */

        public function __construct($repositoryFactory=null/*retirar valor null*/) {
            $this->repositoryFactory = $repositoryFactory;
        }

        /**
         *
         *
         * @return \comunic\social_network_analyzer\model\facade\TweetsFacade
         * @access public
         */
        public function instantiateTweets() {
            return new TweetsFacade();
        }

// end of member function instantiateTweets

        /**
         *
         *
         * @return \comunic\social_network_analyzer\model\facade\CategoriesFacade
         * @access public
         */
        public function instantiateCategories() {
            return new CategoriesFacade();
        }

// end of member function instantiateCategories

        /**
         *
         *
         * @return \comunic\social_network_analyzer\model\facade\UsersFacade
         * @access public
         */
        public function instantiateUsers() {
            return new UsersFacade();
        }

// end of member function instantiateUsers
    }

} // end of FacadeFactory
?>
