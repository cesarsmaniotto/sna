<?php

namespace comunic\social_network_analyzer\model\entity\writers{

	use comunic\social_network_analyzer\model\util\WriterCSV;

	class EntityToCSV{

		public function __invoke($file,$objects,$toArrayFunc,$delimiter="|"){

			$fObjToArray = $toArrayFunc;


			$header = \array_keys($fObjToArray($objects[0]));
			$data = array();

			foreach ($objects as $obj) {
				$data[] = \array_values($fObjToArray($obj));
			}
			
			WriterCSV::write($file,$header,$data,$delimiter);


		}



	}


}

?>