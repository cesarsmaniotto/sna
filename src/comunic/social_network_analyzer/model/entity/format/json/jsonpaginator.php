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


            foreach ($paginator->getObjectList() as $obj) {
                $data[] = $this->toMap($obj);
            }

            $document["data"] = $data;

            return \json_encode($document);

        }

        private function toMap($obj){

            $funcObjToMap = $this->objToMap;

            $dados=$funcObjToMap($obj);
            unset($dados['_id']);
            $dados["id"] = $obj->getId();
            return $dados;

        return $funcTweetToArray($obj);

        }





    }



}

?>