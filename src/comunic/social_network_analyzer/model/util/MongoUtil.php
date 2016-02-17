<?php


namespace comunic\social_network_analyzer\model\util{


	class MongoUtil{


		public static function removeMongoIdObject(array $array){

			foreach ($array as $k => $v) { 
				if (is_array($v)) { 
					$array[$k] = self::removeMongoIdObject($v); 
				} else { 
					if ("_id" === $k) { 
						unset($array[$k]);
						$array["id"] = (string) $v; 
					} 
				} 
			} 

			return $array; 

		}

		public static function includeMongoIdObject(array $array){

			foreach ($array as $k => $v) { 
				if (is_array($v)) { 
					$array[$k] = self::includeMongoIdObject($v); 
				} else { 
					if ("id" === $k) { 
						unset($array[$k]);
						$array["_id"] = new \MongoId($v); 
					} 
				} 
			} 

			return $array; 

		}

		



	}
}