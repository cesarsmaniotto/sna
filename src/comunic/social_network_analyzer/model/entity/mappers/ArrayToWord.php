<?php

namespace comunic\social_network_analyzer\model\entity\mappers{


use \comunic\social_network_analyzer\model\entity\Word;

    class ArrayToWord{

        public function __invoke($arrayData){
            $word = new Word();

            if (isset($arrayData['id'])) {
                  $word->setId($arrayData['id']);
            }

            if (isset($arrayData['word'])) {
                 $word->setWord($arrayData['word']);
            }

            return $word;

        }


    }



}



?>