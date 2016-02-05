<?php

namespace comunic\social_network_analyzer\model\repository{
/**
 * class IDatasetsRepository
 *
 */
interface IDatasetsRepository
{

  /** Aggregations: */

  /** Compositions: */

  /**
   *
   *
   * @param comunic::social_network_analyzer::model::entity::Dataset dataset
   * @return void
   * @access public
   */
  public function insert( $dataset, $projectId);

  /**
   *
   *
   * @param comunic::social_network_analyzer::model::entity::Dataset dataset
   * @return void
   * @access public
   */
  public function update( $dataset, $projectId);

  /**
   *
   *
   * @param int id
   * @return void
   * @access public
   */
  public function delete( $id, $projectId);

  /**
   *
   *
   * @return void
   * @access public
   */
  public function listAll($projectId);

  /**
   *
   *
   * @param int id
   * @return void
   * @access public
   */
  public function findById( $id, $projectId);


}


} // end of IDatasetsRepository
?>
