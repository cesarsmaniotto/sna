<?php

namespace comunic\social_network_analyzer\model\entity{

	class Word{

		private $id;
		private $word;

		function __construct($id=null, $word=null){

			$this->id = strval($id);
			$this->word = $word;
		}

		public function getId()
		{
		    return $this->id;
		}
		 
		public function setId($id)
		{
		    return $this->id = $id;
		}

		public function getWord()
		{
		    return $this->word;
		}
		 
		public function setWord($word)
		{
		    return $this->word = $word;
		}


		public function __toString()
		    {
		        return $this->word;
		   }

		

	}


}

?>