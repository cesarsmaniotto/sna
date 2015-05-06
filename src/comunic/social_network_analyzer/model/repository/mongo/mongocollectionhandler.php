<?php

namespace comunic\social_network_analyzer\model\repository\mongo{



    class MongoCollectionHandler{

        private $collection;

        function __construct($collectionName){

            $conn = new ConnectionMongo();
            $conn = $conn->getConnection();


            $this->collection = $conn->selectCollection($collectionName);

        }

        /**
        * Retorna um cursor para o resultado da consulta, inicialmente retorna apenas 20 documentos
        */
        public function find($toObjectFunction,$query = array(), $fields=array()){
            $cur=$this->collection->find($query,$fields);
            $outputObject=$this->cursorToObjectArray($toObjectFunction,$cur);
            return  $outputObject;

        }

        private function cursorToObjectArray($toObjectFunction,$cursor){
            $outputObjects=array();

            foreach ($cursor as $item) {
                $outputObjects[]=$toObjectFunction($item);
            }

            return $outputObjects;

        }

        public function findInAnInterval($initial, $final, $toObjectFunction,$query = array(), $fields=array()){
            $cursor = $this->collection->find($query,$fields);
            $cursor = $cursor->skip($initial);
            $cur=$cursor->limit($final);
            $outputObject=$this->cursorToObjectArray($toObjectFunction,$cur);
            return $outputObject;
        }

        //retorna um array com os dados de um documento
        public function findOne($toObjectFunction,$query = array(), $fields=array()){
            $arrayData=$this->collection->findOne($query,$fields);
            return $toObjectFunction($arrayData);

        }

        public function save($obj, $toArrayDataFunction,$options=array()){

            try {


               $arrayData=$toArrayDataFunction($obj);

                return $this->collection->save($arrayData, $options);

            } catch (\MongoCursorException $e) {

                echo $e->getMessage();

            }catch (\MongoException $e) {

                echo $e->getMessage();
            }
        }



        public function delete($criteria=array(), $options=array()){

            try {

                return $this->collection->remove($criteria, $options);

            } catch (\MongoCursorException $e) {

                echo $e->getMessage();
            }
        }
    }
}

?>