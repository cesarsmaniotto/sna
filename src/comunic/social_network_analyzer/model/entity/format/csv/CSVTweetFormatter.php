<?php

namespace comunic\social_network_analyzer\model\entity\format\csv{

	use comunic\social_network_analyzer\model\entity\format\IObjectFormatter;

	use comunic\social_network_analyzer\model\entity\mappers\TweetToArray;

	use comunic\social_network_analyzer\model\util\StringUtil;

	class CSVTweetFormatter implements IObjectFormatter{

		private $enclosure;
		private $delimiter;

		function __construct($delimiter='|',$enclosure='"'){
			$this->enclosure = $enclosure;
			$this->delimiter = $delimiter;
		}


		public function format($objects){

			$toArray = new TweetToArray();

			$header = \implode("|",\array_keys($toArray($objects[0]))) ."\n";

			$rows=$header;

			foreach ($objects as $obj) {

				$enclosedAttribs = $this->encloseAttributes(array_values($toArray($obj)));

				$withoutLineBreaks = StringUtil::removeLineBreaks(\implode($this->delimiter,$enclosedAttribs));

				$rows.=$withoutLineBreaks. "\n";

			}

			return $rows;

		}

		private function encloseAttributes($attributes){

			$enclosed = array();

			foreach ($attributes as $attrib) {
				$attrib = $this->addEnclosure($attrib);
				$enclosed[] = $this->enclosure.$attrib.$this->enclosure;
			}

			return $enclosed;

		}

		private function addEnclosure($string){
			return \str_replace($this->enclosure, \str_repeat($this->enclosure,2),$string);
		}

	}

}



?>
