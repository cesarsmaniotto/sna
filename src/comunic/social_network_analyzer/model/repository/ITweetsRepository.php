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
   * @param  \comunic\social_network_analyzer\model\entity\Tweet $tweet
   * @return void
   * @access public
   */
  public function insert( $tweets);

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
   * @param \comunic\social_network_analyzer\model\entity\Category  $category
   * @return array An array of Tweet's instances
   * @see \comunic\social_network_analyzer\model\entity\Tweet
   * @access public
   */
  public function findByCategory($datasetId, $category,$options);


public function listByDatasetInAnInterval($datasetId, $options);

public function findbyCategoryInAnInterval($datasetId,$category, $options);


}



} // end of ITweetsRepository
?>
