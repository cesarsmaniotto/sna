<?php

namespace comunic\social_network_analyzer\model\repository\mongo{

use \comunic\social_network_analyzer\model\repository\mongo\MongoCollectionHandler;
use \comunic\social_network_analyzer\model\repository\IProjectsRepository;
use comunic\social_network_analyzer\model\entity\mappers\ArrayToProject;
use comunic\social_network_analyzer\model\entity\mappers\ProjectToArray;

class ProjectsRepository implements IProjectsRepository{

	private $mongoch;

	public function __construct(){
		$this->mongoch = new MongoCollectionHandler('projects');
	}

	public function insert($project){
		return $this->mongoch->save($project, new ProjectToArray());
	}

	public function listAll(){
		return $this->mongoch->find(new ArrayToProject());
	}

	public function findById($id){
		return $this->mongoch->findOne(new ArrayToProject, array('_id' => new \MongoId($id)));
	}

	public function delete($id){
		return $this->mongoch->delete(array('_id' => new \MongoId($id)));
	}

	public function update($project){
		return $this->mongoch->save($project, new ProjectToArray());
	}



}

}

?>