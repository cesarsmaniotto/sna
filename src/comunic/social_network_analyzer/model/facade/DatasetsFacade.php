<?php

namespace comunic\social_network_analyzer\model\facade{

use comunic\social_network_analyzer\model\repository\IDatasetsRepository;
/**
 * class DatasetsFactory
 *
 */
class DatasetsFacade
{

  /** Aggregations: */

  /** Compositions: */

   /*** Attributes: ***/

   private $repository;

   function __construct($repository){
    $this->repository = $repository;
   }


  /**
   *
   *
   * @param comunic::social_network_analyzer::model::entity::format::IObjectFormatter format
   * @return void
   * @access public
   */
  public function listAll( $format) {

    $datasets = $this->repository->listAll();
    return $format->format($datasets);
  } // end of member function listAll

  /**
   *
   *
   * @param int id
   * @param comunic::social_network_analyzer::model::entity::format::IObjectFormatter format
   * @return void
   * @access public
   */
  public function findById( $id,  $format) {
    $dataset = $this->repository->findById($id);
    return $format->format($dataset);
  } // end of member function findById

  /**
   *
   *
   * @param int id
   * @return void
   * @access public
   */
  public function delete( $id) {
    $this->repository->delete($id);
  } // end of member function delete

  /**
   *
   *
   * @param string datasetText
   * @param comunic::social_network_analyzer::model::entity::parse::IObjectParser parser
   * @return void
   * @access public
   */
  public function insert( $datasetText,  $parser) {
    $datasets = $parser->parse($datasetText);
    return $this->repository->insert($datasets);
  } // end of member function insert

  /**
   *
   *
   * @param comunic::social_network_analyzer::model::entity::parse::IObjectParser parser
   * @param string datasetText
   * @return void
   * @access public
   */
  public function update( $parser,  $datasetText) {
    $datasets = $parser->parse($datasetText);
    return $this->repository->insert($datasets);
  } // end of member function update


}


} // end of DatasetsFactory
?>
