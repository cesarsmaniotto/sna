<?php

namespace comunic\social_network_analyzer\model\facade{

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
  public function findById( $id,  $format) {
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
    $project = $this->projectsRepo->findById($projectId);
    unset($project->getDatasetsId()[$dataset->getId()]);
    $projectsRepo->update($project);

    $this->datasetsRepo->delete($datasetId);
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

    $project = $this->projectsRepo->findById($projectId);
    $project->setDatasetsId($project->getDatasetsId()[]=$dataset->getId());
    $projectsRepo->update($project);
    return $this->datasetsRepo->insert($dataset);
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
    return $this->datasetsRepo->insert($datasets);
  } // end of member function update


}


} // end of DatasetsFactory
?>
