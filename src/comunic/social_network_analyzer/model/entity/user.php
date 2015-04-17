<?php

namespace comunic\social_network_analyzer\model\entity{
/**
 * class User
 *
 */
class User
{

  /** Aggregations: */

  /** Compositions: */

   /*** Attributes: ***/

  private $id;
  private $name;

/**
* @return $id
* @access public
*/


public function getId(){
    return $this->id;
}

   /**
* @return $name
* @access public
*/

public function getName(){
    return $this->name;
}

   /**
* @param $id
* @return void
* @access public
*/

public function setId($id){
    $this->id = $id;
}

   /**
* @param $id
* @return void
* @access public
*/

public function setName($name){
    $this->name = $name;
}



}

} // end of User
?>
