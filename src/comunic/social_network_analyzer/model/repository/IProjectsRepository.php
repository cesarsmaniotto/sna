<?php

namespace comunic\social_network_analyzer\model\repository{

interface IProjectsRepository{

	public function insert($project);

	public function update($project);

	public function delete($id);

	public function listAll();

	public function findById($id);


}

}


?>