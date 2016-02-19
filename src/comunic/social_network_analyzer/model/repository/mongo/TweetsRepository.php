<?php

namespace comunic\social_network_analyzer\model\repository\mongo {

    use \comunic\social_network_analyzer\model\repository\mongo\MongoCollectionHandler;
    use \comunic\social_network_analyzer\model\repository\ITweetsRepository;
    use comunic\social_network_analyzer\model\entity\mappers\ArrayToTweet;
    use comunic\social_network_analyzer\model\entity\mappers\TweetToArray;
    use comunic\social_network_analyzer\model\util\StringUtil;
    use comunic\social_network_analyzer\model\util\MongoUtil;
    use comunic\social_network_analyzer\model\entity\Paginator;



    class TweetsRepository implements ITweetsRepository {

        private $collection;

        function __construct($connectionType) {

            $conn = new ConnectionMongo();
            $conn = $conn->getConnection($connectionType);
            $this->collection = $conn->selectCollection("tweets");

        }

        public function insert($tweet) {


            try {
                $toArray = new TweetToArray();

                $arrayData = MongoUtil::includeMongoIdObject($toArray($tweet));

                return $this->collection->save($arrayData, $options=array());

            } catch (\MongoCursorException $e) {

                echo $e->getMessage();

            }catch (\MongoException $e) {

                echo $e->getMessage();
            }


        }

        public function findById($id) {

            $arrayData=$this->collection->findOne(array('_id' => new \MongoId($id)),$fields=array());

            $toTweet = new ArrayToTweet();

            return $toTweet(MongoUtil::removeMongoIdObject($arrayData));
        }

        public function listAll() {

            $cursor=$this->collection->find($query=array(),$fields=array());

            $outputObjects=array();

            $toTweet = new ArrayToTweet();

            foreach ($cursor as $item) {

                $outputObjects[]=$toTweet(MongoUtil::removeMongoIdObject($item));
            }

            return $outputObjects;
        }

        public function listByDataset($idDataset, $options){

            \extract($options);

            $cursor=$this->collection->find(array("idDataset" => $idDataset),$fields=array());
            $cursor->sort(array($sortBy => $direction));
            $outputObjects=array();

            $toTweet = new ArrayToTweet();

            foreach ($cursor as $item) {

                $outputObjects[]=$toTweet(MongoUtil::removeMongoIdObject($item));
            }

            return $outputObjects;

        }

        public function findByCategory($datasetId, $category, $options) {

            \extract($options);

            $mongoRegex = array();
            foreach ($kwAsRegex as $kw) {
                $mongoRegex[]= new \MongoRegex(StringUtil::removeAccents($kw));
            }

            $cursor = $this->collection->find(array('$and' => array(array('idDataset' => $idDataset),array('textNormalized' => array('$in' => $mongoRegex)))),  $fields=array());
            $cursor->sort(array($sortBy => $direction));
            $outputObjects=array();
            $toTweet = new ArrayToTweet();
            foreach ($cursor as $item) {

                $outputObjects[]=$toTweet(MongoUtil::removeMongoIdObject($item));
            }

            return $outputObjects;
        }

        public function listInAnInterval($options){

            \extract($options);

            $cursor = $this->collection->find($query=array(),$fields=array());
            $count = $cursor->count();
            $cursor->sort(array($sortBy => $direction));
            $cursor->skip($skip);
            $cursor->limit($amount);
            $outputObjects=array();
            $toTweet = new ArrayToTweet();
            foreach ($cursor as $item) {

                $outputObjects[]=$toTweet(MongoUtil::removeMongoIdObject($item));
            }

            return new Paginator($outputObjects, $count, $skip, $amount);

        }



        public function listByDatasetInAnInterval($idDataset, $options){

            \extract($options);

            $cursor = $this->collection->find(array("idDataset" => $idDataset),$fields=array());
            $count = $cursor->count();
            $cursor->sort(array($sortBy => $direction));
            $cursor->skip($skip);
            $cursor->limit($amount);
            $outputObjects=array();
            $toTweet = new ArrayToTweet();
            foreach ($cursor as $item) {

                $outputObjects[]=$toTweet(MongoUtil::removeMongoIdObject($item));
            }

            return new Paginator($outputObjects, $count, $skip, $amount);

        }

        public function findbyCategoryInAnInterval($idDataset, $kwAsRegex, $options){

            \extract($options);

            $mongoRegex = array();
            foreach ($kwAsRegex as $kw) {
                $mongoRegex[]= new \MongoRegex(StringUtil::removeAccents($kw));
            }

            $cursor = $this->collection->find(array('$and' => array(array('idDataset' => $idDataset),array('textNormalized' => array('$in' => $mongoRegex)))),  $fields=array());
            $count = $cursor->count();
            $cursor->sort(array($sortBy => $direction));
            $cursor->skip($skip);
            $cursor->limit($amount);
            $outputObjects=array();
            $toTweet = new ArrayToTweet();
            foreach ($cursor as $item) {

                $outputObjects[]=$toTweet(MongoUtil::removeMongoIdObject($item));
            }

            return new Paginator($outputObjects, $count, $skip, $amount);

        }

        public function delete($idDataset){

            try {

                return $this->collection->remove(array('idDataset' => $idDataset), $options=array());

            } catch (\MongoCursorException $e) {

                echo $e->getMessage();
            }
        }

        public function searchInTheTextInAnInterval($idDataset,$term, $options){
            \extract($options);

            $cursor = $this->collection->find(['$and' => [array('idDataset' => $idDataset),array('textNormalized' => array('$regex' => new \MongoRegex("/$term/i")))]]);
            $count = $cursor->count();
            $cursor->sort(array($sortBy => $direction));
            $cursor->skip($skip);
            $cursor->limit($amount);
            $outputObjects=array();
            $toTweet = new ArrayToTweet();
            foreach ($cursor as $item) {

                $outputObjects[]=$toTweet(MongoUtil::removeMongoIdObject($item));
            }

            return new Paginator($outputObjects, $count, $skip, $amount);
        }

        public function searchInTheText($idDataset,$term, $options){
            \extract($options);

            $cursor = $this->collection->find(['$and' => [array('idDataset' => $idDataset),array('textNormalized' => array('$regex' => new \MongoRegex("/$term/i")))]]);
            
            $outputObjects=array();
            $toTweet = new ArrayToTweet();
            foreach ($cursor as $item) {

                $outputObjects[]=$toTweet(MongoUtil::removeMongoIdObject($item));
            }

            return $outputObjects;
        }

    //     private function filterByCategory($category){
    //         $keywords = $category->getKeywords();
    //         $keywordsAsRegex = array();


    //         //TODO criar uma interface CategoryToExpReg e uma classe CategoryToExpRegMongo que implemente esta classe e monte as expressões
    //         //regulares das categorias conforme convencionado para busca no mongo

    //         /*

    //         =============AINDA FALTA TESTAR ISSO MELHOR============

    //         Todas as consultas são case insensitive e ignoram caracteres acentuados
    //         caso 1: <termo>* ou *<termo>
    //         caso 2: <termo>? ou ?<termo>
    //         caso 3: caso padrão *<termo>*
    //         */
    //         foreach ($keywords as $keyword) {

    //            // $keyword = StringUtil::accentToRegex($keyword);

    //             if(\substr_count($keyword, "*")>=1){
    //                 $keyword = StringUtil::accentToRegex($keyword);
    //                 if(\strpos($keyword, "*")==0){
    //                     $keyword = StringUtil::accentToRegex($keyword);
    //                     $keywordsAsRegex[] = new \MongoRegex("/$keyword\b/i");
    //                 }else{
    //                     $keyword = StringUtil::accentToRegex($keyword);
    //                     $keywordsAsRegex[] = new \MongoRegex("/\b$keyword/i");
    //                 }

    //             }elseif(\substr_count($keyword, "?")>=1 and $keyword != "?"){

    //                 if(\strpos($keyword, "?")==0){
    //                    // $keyword = \str_replace("?", "", $keyword);
    //                    $keyword = StringUtil::accentToRegex($keyword);
    //                    $keywordsAsRegex[] = new \MongoRegex("/$keyword\b/i");
    //                }else{
    //                    // $keyword = \str_replace("?", "", $keyword);
    //                    $keyword = StringUtil::accentToRegex($keyword);
    //                    $keywordsAsRegex[] = new \MongoRegex("/\b$keyword?/i");
    //                }

    //            }else{
    //             $keyword = StringUtil::accentToRegex($keyword);
    //             $keywordsAsRegex[] = new \MongoRegex('/\b'.$keyword.'\b/i');

    //         }
    //     }
    //     return $keywordsAsRegex;
    // }


}

}



?>