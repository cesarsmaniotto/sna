<?php

namespace comunic\social_network_analyzer\model\entity\format\csv{

	use comunic\social_network_analyzer\model\entity\format\IObjectFormatter;
	use comunic\social_network_analyzer\model\entity\Tweet;
	use comunic\social_network_analyzer\model\entity\mappers\TweetToArray;

	class CSVTweetFormatter implements IObjectFormatter{


		public function format($objects){

			$toArray = new TweetToArray();

			$header = \implode("|",\array_keys($toArray($objects[0]))) ."\n";

			$rows=$header;

			foreach ($objects as $obj) {
				// $rows.=$obj->getText()."|";
				// $rows.=$obj->getToUserId()."|";
				// $rows.=$obj->getFromUser()."|";
				// $rows.=$obj->getId()."|";
				// $rows.=$obj->getFromUserId()."|";
				// $rows.=$obj->getSource()."|";
				// $rows.=$obj->getProfileImageUrl()."|";
				// $rows.=$obj->getGeoType()."|";
				// $rows.=$obj->getGeoCoordinates0()."|";
				// $rows.=$obj->getGeoCoordinates1()."|";
				// $rows.=$obj->getCreatedAt()."|";
				// $rows.=$obj->getTime()."\n";

				$arr = \array_values($toArray($obj));
				$slashes= array();
				foreach ($arr as $v) {
						$slashes[] = addslashes($v);
				}

				$rows.="'".\implode("'|'",\array_values($toArray($obj))) ."'". "\n";
			    // $rows.="'".\implode("'|'",\array_values($toArray($obj))) ."'". "\n";
			}
			 
			return $rows;

		}

	}



}


?>