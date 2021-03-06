<?php


namespace comunic\social_network_analyzer\model\facade{

    
/**
 * class UsersFacade
 *
 */
class UsersFacade
{

  /** Aggregations: */

  /** Compositions: */

  /*** Attributes: ***/

  private $repository;

/**
* @param \comunic\social_network_analyzer\model\repository\IUsersRepository $repository
* @access public
*/

public function __construct($repository){
  $this->repository = $repository;
}


  /**
   *
   *
   * @param string $user_text
   * @param \comunic\social_network_analyzer\model\entity\parse\IObjectParser $parser
   * @return void
   * @access public
   */

  public function insert( $user_text,  $parser) {
    $user = $parser->parse($user_text);
    $this->repository->insert($user);


  } // end of member function insert

  /**
   *
   *
   * @param string $user_text
   * @param \comunic\social_network_analyzer\model\entity\parse\IObjectParser $parser
   * @return void
   * @access public
   */
  public function update( $user_text,  $parser) {
    $user = $parser->parse($user_text);
    $this->repository->update($user);
  } // end of member function update

  /**
   *
   *
   * @param int $id
   * @param \comunic\social_network_analyzer\model\entity\format\IObjectFormatter $fmt
   * @return string
   * @access public
   */
  public function findById( $id,  $fmt) {
    return $fmt->format($this->repository->findById($id));
  } // end of member function findById

  /**
   *
   *
   * @param int $id
   * @return void
   * @access public
   */
  public function delete( $id) {
    $this->repository->delete($id);
  } // end of member function delete

  /**
   *
   *
   * @param \comunic\social_network_analyzer\model\entity\format\IObjectFormatter $fmt
   * @return string
   * @access public
   */
  public function listAll( $fmt) {
    return $fmt->format($this->repository->listAll());
  } // end of member function listAll


}


} // end of UsersFacade
?>
