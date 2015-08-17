<?php

namespace comunic\social_network_analyzer\model\entity{
/**
 * class Tweet
 *
 */
class Tweet
{

  /** Aggregations: */

  /** Compositions: */

  /*** Attributes: ***/

/**
* attribute id is the id of object on database
* attribute idTweet is the id of tweet
*/

private $id;
private $text;
private $toUserId;
private $fromUser;
// private $idTweet;
private $fromUserId;
private $isoLanguageCode;
private $source;
private $profileImageUrl;
private $geoType;
private $geoCoordinates0;
private $geoCoordinates1;
private $createdAt;
private $time;

public function getId()
{
    return $this->id;
}

public function setId($id)
{
    return $this->id = $id;
}

public function getText()
{
    return $this->text;
}

public function setText($text)
{
    return $this->text = $text;
}

public function getToUserId()
{
    return $this->toUserId;
}

public function setToUserId($toUserId)
{
    return $this->toUserId = $toUserId;
}

public function getFromUser()
{
    return $this->fromUser;
}

public function setFromUser($fromUser)
{
    return $this->fromUser = $fromUser;
}

// public function getIdTweet()
// {
//     return $this->idTweet;
// }

// public function setIdTweet($idTweet)
// {
//     return $this->idTweet = $idTweet;
// }

public function getFromUserId()
{
    return $this->fromUserId;
}

public function setFromUserId($fromUserId)
{
    return $this->fromUserId = $fromUserId;
}

public function getIsoLanguageCode()
{
    return $this->isoLanguageCode;
}

public function setIsoLanguageCode($isoLanguageCode)
{
    return $this->isoLanguageCode = $isoLanguageCode;
}

public function getSource()
{
    return $this->source;
}

public function setSource($source)
{
    return $this->source = $source;
}

public function getProfileImageUrl()
{
    return $this->profileImageUrl;
}

public function setProfileImageUrl($profileImageUrl)
{
    return $this->profileImageUrl = $profileImageUrl;
}

public function getGeoType()
{
    return $this->geoType;
}

public function setGeoType($geoType)
{
    return $this->geoType = $geoType;
}

public function getGeoCoordinates0()
{
    return $this->geoCoordinates0;
}

public function setGeoCoordinates0($geoCoordinates0)
{
    return $this->geoCoordinates0 = $geoCoordinates0;
}


public function getGeoCoordinates1()
{
    return $this->geoCoordinates1;
}

public function setGeoCoordinates1($geoCoordinates1)
{
    return $this->geoCoordinates1 = $geoCoordinates1;
}

public function getCreatedAt()
{
    return $this->createdAt;
}

public function setCreatedAt($createdAt)
{
    return $this->createdAt = $createdAt;
}

public function getTime()
{
    return $this->time;
}

public function setTime($time)
{
    return $this->time = $time;
}

}

} // end of Tweet
?>
