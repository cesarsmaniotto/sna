<?php

namespace comunic\social_network_analyzer\model\entity\format\json {

    use comunic\social_network_analyzer\model\entity\format\IObjectFormatter;

    class BasicObjectFormatter implements IObjectFormatter {

        private $funcToArray;

        function __construct($funcToArray){
            $this->funcToArray = $funcToArray;
        }


        public function format($obj) {
            if (\is_array($obj)) {

                $data = array();

                foreach ($obj as $item) {
                    $data[] = $this->funcToArray->__invoke($item);
                }

                return \json_encode($data);
            }

            return \json_encode($this->funcToArray->__invoke($obj));
        }
    }

}