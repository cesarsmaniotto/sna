<?php

namespace comunic\social_network_analyzer\model\entity\parse\json{

use comunic\social_network_analyzer\model\entity\parse\IObjectParser;

abstract class BasicObjectParser implements IObjectParser{

    public function parse($jsonText){

        $jsonObj = \json_decode($jsonText);

        if(\is_array($jsonObj)){

            $listObjects = array();

            foreach ($jsonObj as $item) {
                $listObjects[] = $this->createObject($item);
            }

            return $listObjects;

        }
        return $this->createObject($jsonObj);
    }

    protected abstract function createObject($jsonObj);


}



}

?>