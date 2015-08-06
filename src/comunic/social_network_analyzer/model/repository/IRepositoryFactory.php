<?php


namespace comunic\social_network_analyzer\model\repository{
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
   * @return \comunic\social_network_analyzer\model\repository\IUsersRepository
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

    /**
   *
   *
   * @return  \comunic\social_network_analyzer\model\repository\IProjectsRepository
   * @access public
   */
  public function instantiateProject();

    /**
   *
   *
   * @return  \comunic\social_network_analyzer\model\repository\IDatasetsRepository
   * @access public
   */
  public function instantiateDataset();



}

} // end of IRepositoryFactory
?>
