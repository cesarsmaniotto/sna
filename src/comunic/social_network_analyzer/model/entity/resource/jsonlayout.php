<?php

namespace comunic\social_network_analyzer\model\entity\resource{

    class JsonLayout{


        public function __invoke($data, $count, $page, $amountPerPage){

            $document = array();


            $document["count"] = $count;
            $document["page"] = $page;
            $document["pages"] =  \ceil($count / $amountPerPage);
            $document["data"] = \json_decode($data);

            return \json_encode($document);


        }



    }



}

?>