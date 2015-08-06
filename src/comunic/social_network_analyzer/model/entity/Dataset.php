<?php

namespace comunic\social_network_analyzer\model\entity{
  /**
 * class Dataset
 *
 */
class Dataset
{

  /** Aggregations: */

  /** Compositions: */

   /*** Attributes: ***/
  /**
   *
   * @access private
   */
  private $id;
  private $name;
  private $hasTweets;

  function __construct(){
    $this->hasTweets = false;
  }


public function getId()
{
    return $this->id;
}

public function setId($id)
{
    return $this->id = $id;
}

public function getName()
{
    return $this->name;
}

public function setName($name)
{
    return $this->name = $name;
}

public function getHasTweets()
{
    return $this->hasTweets;
}
 
public function setHasTweets($hasTweets)
{
    return $this->hasTweets = $hasTweets;
}

}



 // end of Dataset
}
?>
