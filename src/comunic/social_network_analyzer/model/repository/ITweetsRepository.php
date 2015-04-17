<?php


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
   * @param  tweet 

   * @return void
   * @access public
   */
  public function insert( $tweet);

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
   * @param  id 

   * @return void
   * @access public
   */
  public function findById( $id);

  /**
   * 
   *
   * @param  category 

   * @return void
   * @access public
   */
  public function listByCategory( $category);





} // end of ITweetsRepository
?>
