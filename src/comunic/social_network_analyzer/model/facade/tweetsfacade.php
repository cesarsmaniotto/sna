<?php

use \comunic\social_network_analyzer\model\entity\format\IObjectFormatter;
use \comunic\social_network_analyzer\model\entity\parse\IObjectParser;

namespace comunic\social_network_analyzer\model\facade{
/**
 * class TweetsFacade
 *
 */
class TweetsFacade
{

  /** Aggregations: */

  /** Compositions: */

   /*** Attributes: ***/


  /**
   *
   *
   * @param string $text
   * @param \comunic\social_network_analyzer\model\entity\parse\IObjectParser $parse
   * @return void
   * @access public
   */
  public function insertAll( $text,  $parse) {
  } // end of member function insertAll

  /**
   *
   *
   * @param int $id
   * @param \comunic\social_network_analyzer\model\entity\format\IObjectFormatter $fmt
   * @return string
   * @access public
   */
  public function findById( $id,  $fmt) {
  } // end of member function findById

  /**
   *
   *
   * @param string text_cat
   * @param \comunic\social_network_analyzer\model\entity\parse\IObjectParser $parse
   * @param \comunic\social_network_analyzer\model\entity\format\IObjectFormatter $fmt
   * @return string
   * @access public
   */
  public function listByCategory( $text_cat,  $parse,  $fmt) {
  } // end of member function listByCategory

  /**
   *
   *
   * @param \comunic\social_network_analyzer\model\entity\format\IObjectFormatter $fmt
   * @return string
   * @access public
   */
  public function listAll( $fmt) {
  } // end of member function listAll


}


} // end of TweetsFacade
?>
