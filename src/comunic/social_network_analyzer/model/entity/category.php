<?php

namespace comunic\social_network_analyzer\model\entity{
/**
 * class Category
 *
 */
class Category
{

  /** Aggregations: */

  /** Compositions: */

  /*** Attributes: ***/

  private $id;
  private $name;
  private $keywords;
  private $included;
  private $excluded;

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
* @return $keywords
* @access public
*/

public function getKeywords(){
  return $this->keywords;
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
* @param $name
* @return void
* @access public
*/

public function setName($name){
  $this->name = $name;
}

   /**
* @param $keywords
* @return void
* @access public
*/

public function setKeywords($keywords){
  $this->keywords = $keywords;
}

public function getIncluded()
{
    return $this->included;
}

public function setIncluded($included)
{
    return $this->included = $included;
}

public function getExcluded()
{
    return $this->excluded;
}

public function setExcluded($excluded)
{
    return $this->excluded = $excluded;
}


}


} // end of Category
?>
