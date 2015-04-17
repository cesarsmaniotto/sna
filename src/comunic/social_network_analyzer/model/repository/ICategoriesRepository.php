<?php


/**
 * class ICategoriesRepository
 * 
 */
interface ICategoriesRepository
{

  /** Aggregations: */

  /** Compositions: */

  /**
   * 
   *
   * @param  category 

   * @return void
   * @access public
   */
  public function insert( $category);

  /**
   * 
   *
   * @param  category 

   * @return void
   * @access public
   */
  public function update( $category);

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
   * @param int id 

   * @return void
   * @access public
   */
  public function findById( $id);

  /**
   * 
   *
   * @return void
   * @access public
   */
  public function listAll();





} // end of ICategoriesRepository
?>
