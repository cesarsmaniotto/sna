<?php



namespace comunic\social_network_analyzer\model\facade\arango{

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
  public function import( $tweets,  $datasetId) {

      $this->repositoryTweet->import($tweets, $datasetId);


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

  /**
   *
   *
   * @param string text_cat
   * @param \comunic\social_network_analyzer\model\entity\parse\IObjectParser $parser
   * @param \comunic\social_network_analyzer\model\entity\format\IObjectFormatter $fmt
   * @return string
   * @access public
   */
  public function findByCategory($id_cat, $datasetId, $fmt) {
    $category = $this->categoryRep->findById($id_cat);
    $tweets=$this->repositoryTweet->findByCategory($category);
    return $fmt->format($tweets);
  } // end of member function listByCategory

  /**
   *
   *
   * @param \comunic\social_network_analyzer\model\entity\format\IObjectFormatter $fmt
   * @return string
   * @access public
   */
  public function listAll( $fmt) {
    return $fmt->format($this->repositoryTweet->listAll());
  } // end of member function listAll


  public function listInAnInterval($datasetId, $fmt, $options){

    return $fmt->format($this->repositoryTweet->listInAnInterval($datasetId, $options));
  }

  public function findbyCategoryInAnInterval($datasetId, $id_cat, $fmt, $options){
    $category = $this->categoryRep->findById($id_cat);
    $tweets=$this->repositoryTweet->findbyCategoryInAnInterval($datasetId, $category, $options);
    return $fmt->format($tweets);
  }

}


} // end of TweetsFacade
?>
