<?php

use \comunic\social_network_analyzer\model\repository\ITweetsRepository;
use \comunic\social_network_analyzer\model\repository\IUserRepository;
use \comunic\social_network_analyzer\model\repository\ICategoriesRepository;


namespace comunic\social_network_analyzer\model\repository\{
/**
 * class IRepositoryFactory
 *
 */
interface IRepositoryFactory
{

  /** Aggregations: */

  /** Compositions: */

  /**
   *
   *
   * @return  \comunic\social_network_analyzer\model\repository\ITweetsRepository
   * @access public
   */
  public function instantiateTweet();

  /**
   *
   *
   * @return \comunic\social_network_analyzer\model\repository\IUserRepository
   * @access public
   */
  public function instantiateUser();

  /**
   *
   *
   * @return  \comunic\social_network_analyzer\model\repository\ICategoriesRepository
   * @access public
   */
  public function instantiateCategory();



}

} // end of IRepositoryFactory
?>
