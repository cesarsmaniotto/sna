<?php

namespace comunic\social_network_analyzer\model\entity\format\json {

    use comunic\social_network_analyzer\model\entity\format\IObjectFormatter;

    abstract class BasicObjectFormatter implements IObjectFormatter {


        public function format($obj) {
            if (\is_array($obj)) {

                $data = array();

                foreach ($obj as $item) {
                    $data[] = $this->toMap($item);
                }

                return \json_encode($data);
            }

            return \json_encode($this->toMap($obj));
        }

        abstract protected function toMap($obj);



    }

}