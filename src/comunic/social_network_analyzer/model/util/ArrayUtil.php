<?php

namespace comunic\social_network_analyzer\model\util{

    class ArrayUtil{

        public static function is_assoc_array($array){

         return \array_keys($array) !== \range(0, count($array) - 1);

     }

     public static function eliminates_repeated($array){
       $withoutRepeated = array();

       foreach ($array as $item) {
          $withoutRepeated[$item] = $item;
      }
      return array_values($withoutRepeated);

  }

    public static function slicer($array, $qttPerSlice){
    $slices = array();

    $nSlices = ceil(count($array) / $qttPerSlice);

    for ($i=0; $i <$nSlices ; $i++) { 

      $slices[] = \array_slice($array, $i*($qttPerSlice), $qttPerSlice);

  }

  return $slices;
}

}

}

?>