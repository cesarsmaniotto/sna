<?php

namespace comunic\social_network_analyzer\model\repository{
/**
 * class IUsersRepository
 *
 */
interface IUsersRepository
{

  /** Aggregations: */

  /** Compositions: */

  /**
   *
   *
   * @param  $user \comunic\social_network_analyzer\entity\User
   * @return void
   * @access public
   */
  public function insert( $user);

  /**
   *
   *
   * @param  $user \comunic\social_network_analyzer\entity\User
   * @return void
   * @access public
   */
  public function update( $user);

  /**
   *
   *
   * @param $id int
   * @return void
   * @access public
   */
  public function delete( $id);

  /**
   *
   *
   * @param $id int
   * @return \comunic\social_network_analyzer\entity\User
   * @access public
   */
  public function findById( $id);

  /**
   *
   *
   * @return array An array of User instances
   * @see \comunic\social_network_analyzer\entity\User
   * @access public
   */
  public function listAll();



}

} // end of IUserRepository
?>
