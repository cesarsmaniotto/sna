<?php

namespace comunic\social_network_analyzer\model\entity{

	class Project{


		private $id;
		private $name;
		private $datasets;

		public function getId(){
			return $this->id;
		}

		public function setId($id){
			return $this->id = $id;
		}

		public function getName(){
			return $this->name;
		}

		public function setName($name){
			return $this->name = $name;
		}

		public function getDatasets()
		{
		    return $this->datasets;
		}
		 
		public function setDatasets($datasets)
		{
		    return $this->datasets = $datasets;
		}

	}

}



?>