<?php



namespace comunic\social_network_analyzer\model\facade{

  use \comunic\social_network_analyzer\model\repository\ITweetsRepository;
/**
 * class TweetsFacade
 *
 */
class TweetsFacade
{

  /** Aggregations: */

  /** Compositions: */

  /*** Attributes: ***/

  private $repository;

/**
* @param \comunic\social_network_analyzer\model\repository\ITweetsRepository $repository
* @access public
*/


function __construct($repository){
  $this->repository = $repository;
}
  /**
   *
   *
   * @param string $text
   * @param \comunic\social_network_analyzer\model\entity\parse\IObjectParser $parser
   * @return void
   * @access public
   */
  public function insertAll( $text,  $parser) {
    $tweets = $parser->parse($text);
    foreach ($tweets as $tweet) {
      $repository->insert($tweet);
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
    return $fmt->format($repository->findById($id));
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
  public function listByCategory( $text_cat,  $parser,  $fmt) {
    $category = $parser->parse($text_cat);
    return $fmt->format($category);
  } // end of member function listByCategory

  /**
   *
   *
   * @param \comunic\social_network_analyzer\model\entity\format\IObjectFormatter $fmt
   * @return string
   * @access public
   */
  public function listAll( $fmt) {
    return $fmt->format($repository->listAll());
  } // end of member function listAll


}


} // end of TweetsFacade
?>
