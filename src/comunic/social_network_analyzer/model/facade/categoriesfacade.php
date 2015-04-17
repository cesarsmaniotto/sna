<?php

use \comunic\social_network_analyzer\model\entity\format\IObjectFormatter;
use \comunic\social_network_analyzer\model\entity\parse\IObjectParser;

namespace comunic\social_network_analyzer\model\facade{
/**
 * class CategoriesFacade
 *
 */
class CategoriesFacade
{

  /** Aggregations: */

  /** Compositions: */

   /*** Attributes: ***/


  /**
   *
   *
   * @param string categorie_text
   * @param \comunic\social_network_analyzer\model\entity\parse\IObjectParser parser
   * @return void
   * @access public
   */
  public function insert( $categorie_text,  $parser) {
  } // end of member function insert

  /**
   *
   *
   * @param string categorie_text
   * @param \comunic\social_network_analyzer\model\entity\parse\IObjectParser parser
   * @return void
   * @access public
   */
  public function update( $categorie_text,  $parser) {
  } // end of member function update

  /**
   *
   *
   * @param int id
   * @param \comunic\social_network_analyzer\model\entity\format\IObjectFormatter fmt
   * @return string
   * @access public
   */
  public function findById( $id,  $fmt) {
  } // end of member function findById

  /**
   *
   *
   * @param int id
   * @return void
   * @access public
   */
  public function delete( $id) {
  } // end of member function delete

  /**
   *
   *
   * @param \comunic\social_network_analyzer\model\entity\format\IObjectFormatter fmt
   * @return string
   * @access public
   */
  public function listAll( $fmt) {
  } // end of member function listAll



}

} // end of CategoriesFacade
?>
