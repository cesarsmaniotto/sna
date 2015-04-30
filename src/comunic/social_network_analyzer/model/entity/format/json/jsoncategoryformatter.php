<?php

namespace comunic\social_network_analyzer\model\entity\format\json{

    use \comunic\social_network_analyzer\model\entity\format\IObjectFormatter;

    class JsonCategoryFormatter implements IObjectFormatter{

        public function format($obj){

            if(\is_array($obj)){

                $data = array();

                foreach ($obj as $item) {
                    $data[] = $this->toMap($item);
                }

                return \json_encode($data);
            }

            return \json_encode($this->toMap($obj));
        }


        private function toMap($obj){

            return array(

                'id' => $obj->getId(),
                'name' => $obj->getName(),
                'keywords' => $obj->getKeywords()

                );

        }

    }




}


?>