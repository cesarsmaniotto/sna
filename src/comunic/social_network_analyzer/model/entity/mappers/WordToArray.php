<?php

namespace comunic\social_network_analyzer\model\entity\mappers{

	class WordToArray{

		public function __invoke($obj){

			return array(
				'id' => $obj->getId(),
				'word' => $obj->getWord()
                );
		}
	}
}

?>