<?php

namespace comunic\social_network_analyzer\model\util{


	class WriterCSV{

		public static function write($file, $header, $rows, $delimiter){

			$fp = \fopen($file, 'w+');

			fputcsv($fp, $header, $delimiter);

			foreach ($rows as $row) {
			    \fputcsv($fp, $row, $delimiter);
			}
			 
			\fclose($fp);


		}



	}


}


?>