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
   * @param comunic::social_network_analyzer::model::entity::Dataset project
   * @return void
   * @access public
   */
  public function insert( $project);

  /**
   *
   *
   * @param comunic::social_network_analyzer::model::entity::Dataset project
   * @return void
   * @access public
   */
  public function update( $project);

  /**
   *
   *
   * @param int id
   * @return void
   * @access public
   */
  public function delete( $id);

  /**
   *
   *
   * @return void
   * @access public
   */
  public function listAll();

  /**
   *
   *
   * @param int id
   * @return void
   * @access public
   */
  public function findById( $id);


}


} // end of IDatasetsRepository
?>
