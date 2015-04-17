<?php

use \comunic\social_network_analyzer\model\repository\IRepositoryFactory;
use \comunic\social_network_analyzer\model\facade\TweetsFacade;
use \comunic\social_network_analyzer\model\facade\CategoriesFacade;
use \comunic\social_network_analyzer\model\facade\UsersFacade;

namespace comunic\social_network_analyzer\model\facade{
/**
 * class FacadeFactory
 *
 */
class FacadeFactory
{

  /** Aggregations: */

  /** Compositions: */

   /*** Attributes: ***/

  /**
   *
   * @access private
   */
  private $repositoryFactory;


  /**
   *
   *
   * @return \comunic\social_network_analyzer\model\facade\TweetsFacade
   * @access public
   */
  public function instantiateTweets() {
  } // end of member function instantiateTweets

  /**
   *
   *
   * @return \comunic\social_network_analyzer\model\facade\CategoriesFacade
   * @access public
   */
  public function instantiateCategories() {
  } // end of member function instantiateCategories

  /**
   *
   *
   * @return \comunic\social_network_analyzer\model\facade\UsersFacade
   * @access public
   */
  public function instantiateUsers() {
  } // end of member function instantiateUsers



}

} // end of FacadeFactory
?>
