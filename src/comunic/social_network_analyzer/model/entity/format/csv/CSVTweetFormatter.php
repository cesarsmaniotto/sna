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
			    $rows.=\implode("|",\array_values($toArray($obj))) . "\n";
			}
			 
			return $rows;


			// $csv = Tweet::getHeaderCSV()."<br>";

			// foreach ($objects as $tweet) {
			// 	$csv.=$tweet->getText()."|";
			// 	$csv.=$tweet->getToUserId()."|";
			// 	$csv.=$tweet->getFromUser()."|";
			// 	$csv.=$tweet->getId()."|";
			// 	$csv.=$tweet->getFromUserId()."|";
			// 	$csv.=$tweet->getSource()."|";
			// 	$csv.=$tweet->getProfileImageUrl()."|";
			// 	$csv.=$tweet->getGeoType()."|";
			// 	$csv.=$tweet->getGeoCoordinates0()."|";
			// 	$csv.=$tweet->getGeoCoordinates1()."|";
			// 	$csv.=$tweet->getCreatedAt()."|";
			// 	$csv.=$tweet->getTime()."<br><br>";
			// }
			// return $csv;



		}

	}



}


?>