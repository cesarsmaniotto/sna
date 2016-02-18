<?php



namespace comunic\social_network_analyzer\model\facade\mongo{

/**
 * class TweetsFacade
 *
 */
class TweetsFacade
{

  /** Aggregations: */

  /** Compositions: */

  /*** Attributes: ***/

  private $repositoryTweet;
  private $categoryRep;

/**
* @param \comunic\social_network_analyzer\model\repository\ITweetsRepository $repository
* @access public
*/


function __construct($repository, $categoryRep){
  $this->repositoryTweet = $repository;
  $this->categoryRep = $categoryRep;
}
  /**
   *
   *
   * @param string $text
   * @param \comunic\social_network_analyzer\model\entity\parse\IObjectParser $parser
   * @return void
   * @access public
   */
  public function insert( $text,  $parser, $idDataset) {
    $tweets = $parser->parse($text);
    foreach ($tweets as $tweet) {
      $tweet->setIdDataset($idDataset);
      $this->repositoryTweet->insert($tweet);
    }
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
    return $fmt->format($this->repositoryTweet->findById($id));
  } // end of member function findById

  public function listByDataset($idDataset, $fmt, $options){
    return $fmt->format($this->repositoryTweet->listByDatasetInAnInterval($idDataset, $options));
  }

  public function listByDatasetInAnInterval($idDataset, $fmt, $options){
    return $fmt->format($this->repositoryTweet->listByDatasetInAnInterval($idDataset, $options));
  }

  /**
   *
   *
   * @param string text_cat
   * @param \comunic\social_network_analyzer\model\entity\parse\IObjectParser $parser
   * @param \comunic\social_network_analyzer\model\entity\format\IObjectFormatter $fmt
   * @return string
   * @access public
   */
  public function findByCategory($idDataset, $idCategory, $fmt, $options) {
   $category = $this->categoryRep->findById($idCategory);

      $kwAsRegex = $category->toRegex();

      $tweets=$this->repositoryTweet->findbyCategoryInAnInterval($idDataset, $kwAsRegex, $options);
      return $fmt->format($tweets);
  } // end of member function listByCategory

  public function findbyCategoryInAnInterval($idDataset, $idCategory, $fmt, $options){
    $category = $this->categoryRep->findById($idCategory);

    $kwAsRegex = $category->toRegex();

    $tweets=$this->repositoryTweet->findbyCategoryInAnInterval($idDataset, $kwAsRegex, $options);
    return $fmt->format($tweets);
  }

  public function searchInTheText($term, $fmt, $options){
    return $fmt->format($this->repositoryTweet->searchInTheText($term, $options));
  }

  public function searchInTheTextInAnInterval($term, $fmt, $options){
    return $fmt->format($this->repositoryTweet->searchInTheTextInAnInterval($term, $options));
  }

}


} // end of TweetsFacade
?>
