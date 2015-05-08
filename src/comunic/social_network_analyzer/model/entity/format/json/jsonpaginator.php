<?php

namespace comunic\social_network_analyzer\model\entity\format\json{

    use \comunic\social_network_analyzer\model\entity\format\IObjectFormatter;

    class JsonPaginator implements IObjectFormatter{

        private $objToMap;

        public function __construct($objToMap){
            $this->objToMap = $objToMap;
        }


        public function format($paginator){

            $document = array();


            $document["count"] = $paginator->getCount();
            $document["page"] = $paginator->getPage();
            $document["numberPages"] =  $paginator->getNumberPages();
            $document["amountPerPage"] = $paginator->getAmountPerPage();

            $data = array();

            $functObjToMap = $this->objToMap;

            foreach ($paginator->getObjectList() as $obj) {
                $data[] = $functObjToMap($obj);
            }

            $document["data"] = $data;

            return \json_encode($document);

        }





    }



}

?>