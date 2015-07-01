<?php

namespace comunic\social_network_analyzer\model\util{

    class ArrayUtil{

        public static function is_assoc_array($array){

            return $array === array_values($array);

        }

    }

}

?>