<?php

namespace comunic\social_network_analyzer\model\facade\mongo{

use comunic\social_network_analyzer\model\datasetsRepo\IDatasetsdatasetsRepo;
/**
 * class DatasetsFactory
 *
 */
class DatasetsFacade
{

  /** Aggregations: */

  /** Compositions: */

   /*** Attributes: ***/

   private $datasetsRepo;
   private $projectsRepo;

   function __construct($datasetsRepo, $projectsRepo){
    $this->datasetsRepo = $datasetsRepo;
    $this->projectsRepo = $projectsRepo;
   }


  /**
   *
   *
   * @param comunic::social_network_analyzer::model::entity::format::IObjectFormatter format
   * @return void
   * @access public
   */
  public function listAll( $format) {

    $datasets = $this->datasetsRepo->listAll();
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
  public function findById( $id, $format) {
    $dataset = $this->datasetsRepo->findById($id);
    return $format->format($dataset);
  } // end of member function findById

  /**
   *
   *
   * @param int id
   * @return void
   * @access public
   */
  public function delete( $datasetId, $projectId) {
 

    $this->datasetsRepo->delete($datasetId, $projectId);
  } // end of member function delete

  /**
   *
   *
   * @param string datasetText
   * @param comunic::social_network_analyzer::model::entity::parse::IObjectParser parser
   * @return void
   * @access public
   */
  public function insert( $datasetText,  $projectId, $parser) {
    $dataset = $parser->parse($datasetText);

    return $this->datasetsRepo->insert($dataset, $projectId);
  } // end of member function insert

  /**
   *
   *
   * @param comunic::social_network_analyzer::model::entity::parse::IObjectParser parser
   * @param string datasetText
   * @return void
   * @access public
   */
  public function update($datasetText, $parser, $projectId) {
    $dataset = $parser->parse($datasetText);
    return $this->datasetsRepo->update($dataset, $projectId);
  } // end of member function update


}


} // end of DatasetsFactory
?>
