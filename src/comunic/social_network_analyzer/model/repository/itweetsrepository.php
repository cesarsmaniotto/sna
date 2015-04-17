<?php

namespace comunic\social_network_analyzer\model\repository{
/**
 * class ITweetsRepository
 *
 */
interface ITweetsRepository
{

  /** Aggregations: */

  /** Compositions: */

  /**
   *
   *
   * @param  $tweet \comunic\social_network_analyzer\model\entity\Tweet
   * @return void
   * @access public
   */
  public function insert( $tweet);

  /**
   *
   *
   * @return array An array of Tweet's instances
   * @see \comunic\social_network_analyzer\model\entity\Tweet
   * @access public
   */
  public function listAll();

  /**
   *
   *
   * @param  $id
   * @return \comunic\social_network_analyzer\model\entity\Tweet
   * @access public
   */
  public function findById( $id);

  /**
   *
   * @param  $category \comunic\social_network_analyzer\model\entity\Category 
   * @return array An array of Tweet's instances
   * @see \comunic\social_network_analyzer\model\entity\Tweet
   * @access public
   */
  public function listByCategory( $category);



}

} // end of ITweetsRepository
?>
