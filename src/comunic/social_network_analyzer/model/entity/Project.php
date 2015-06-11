<?php

namespace comunic\social_network_analyzer\model\entity{

	class Project{


		private $id;
		private $name;

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





	}

}



?>