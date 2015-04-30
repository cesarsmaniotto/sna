<?php

namespace comunic\social_network_analyzer\model\entity\format\json {

    use comunic\social_network_analyzer\model\entity\format\IObjectFormatter;

    class BasicObjectFormatter implements IObjectFormatter {

        private $objectToMap;

        public function __construct($objectToMap) {
            $this->objectToMap = $objectToMap;
        }

        public function format($obj) {
            $toMap=$this->objectToMap;
            if (\is_array($obj)) {

                $data = array();

                foreach ($obj as $item) {
                    $data[] = $toMap($item);
                }

                return \json_encode($data);
            }

            return \json_encode($toMap($obj));
        }

    }

}