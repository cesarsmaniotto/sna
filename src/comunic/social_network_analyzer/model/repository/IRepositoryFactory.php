<?php
require_once 'comunic/social_network_analyzer/model/repository/ITweetsRepository.php';
require_once 'comunic/social_network_analyzer/model/repository/IUserRepository.php';
require_once 'comunic/social_network_analyzer/model/repository/ICategoriesRepository.php';


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
   * @return comunic::social_network_analyzer::model::repository::ITweetsRepository
   * @access public
   */
  public function instantiateTweet();

  /**
   * 
   *
   * @return comunic::social_network_analyzer::model::repository::IUserRepository
   * @access public
   */
  public function instantiateUser();

  /**
   * 
   *
   * @return comunic::social_network_analyzer::model::repository::ICategoriesRepository
   * @access public
   */
  public function instantiateCategory();





} // end of IRepositoryFactory
?>
