<?php

namespace comunic\social_network_analyzer\model\entity\parse\json{

use comunic\social_network_analyzer\model\entity\parse\IObjectParser;
use comunic\social_network_analyzer\model\util\ArrayUtil;

abstract class BasicObjectParser implements IObjectParser{

    public function parse($jsonText){

        $arrayData = \json_decode($jsonText, true);

        if(ArrayUtil::is_assoc_array($arrayData)){

            return $this->createObject($arrayData);

        }

        if(\is_array($arrayData)){

            $listObjects = array();

            foreach ($arrayData as $item) {
                $listObjects[] = $this->createObject($item);
            }

            return $listObjects;

        }
    }

    protected abstract function createObject($arrayData);


}



}

?>