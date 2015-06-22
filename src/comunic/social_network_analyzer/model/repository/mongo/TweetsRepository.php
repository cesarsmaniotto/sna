<?php

namespace comunic\social_network_analyzer\model\repository\mongo {

    use \comunic\social_network_analyzer\model\repository\mongo\MongoCollectionHandler;
    use \comunic\social_network_analyzer\model\repository\ITweetsRepository;
    use \comunic\social_network_analyzer\model\entity\mappers\ArrayToTweet;
    use comunic\social_network_analyzer\model\entity\mappers\TweetToArray;
    use comunic\social_network_analyzer\model\util\StringUtil;



    class TweetsRepository implements ITweetsRepository {

        private $mongoch;

        function __construct() {
            $this->mongoch = new MongoCollectionHandler('tweets');
        }

        public function insert($tweet) {
            if($this->mongoch->count(array("text" => $tweet->getText())) == 0){
                return $this->mongoch->save($tweet ,new TweetToArray());
            }

        }

        public function listAll() {

            return $this->mongoch->find(new ArrayToTweet());
        }

        public function listInAnInterval($initial, $final){
            return $this->mongoch->findInAnInterval($initial, $final, new ArrayToTweet());
        }

        public function findById($id) {

            return $this->mongoch->findOne(new ArrayToTweet(), array('_id' => new \MongoId($id)));
        }

        private function filterByCategory($category){
            $keywords = $category->getKeywords();
            $keywordsAsRegex = array();


            //TODO criar uma interface CategoryToExpReg e uma classe CategoryToExpRegMongo que implemente esta classe e monte as expressões
            //regulares das categorias conforme convencionado para busca no mongo

            /*

            =============AINDA FALTA TESTAR ISSO MELHOR============

            Todas as consultas são case insensitive e ignoram caracteres acentuados
            caso 1: <termo>* ou *<termo>
            caso 2: <termo>? ou ?<termo>
            caso 3: caso padrão *<termo>*
            */
            foreach ($keywords as $keyword) {

               // $keyword = StringUtil::accentToRegex($keyword);

                if(\substr_count($keyword, "*")>=1){
                    $keyword = StringUtil::accentToRegex($keyword);
                 if(\strpos($keyword, "*")==0){
                    $keyword = StringUtil::accentToRegex($keyword);
                         $keywordsAsRegex[] = new \MongoRegex("/$keyword\b/i");
                    }else{
                        $keyword = StringUtil::accentToRegex($keyword);
                        $keywordsAsRegex[] = new \MongoRegex("/\b$keyword/i");
                    }

                }elseif(\substr_count($keyword, "?")>=1 and $keyword != "?"){

                    if(\strpos($keyword, "?")==0){
                       // $keyword = \str_replace("?", "", $keyword);
                       $keyword = StringUtil::accentToRegex($keyword);
                      $keywordsAsRegex[] = new \MongoRegex("/$keyword\b/i");
                    }else{
                       // $keyword = \str_replace("?", "", $keyword);
                       $keyword = StringUtil::accentToRegex($keyword);
                        $keywordsAsRegex[] = new \MongoRegex("/\b$keyword?/i");
                    }

                }else{
                    $keyword = StringUtil::accentToRegex($keyword);
                 $keywordsAsRegex[] = new \MongoRegex('/\b'.$keyword.'\b/i');

             }
         }
         return $keywordsAsRegex;
     }

     public function findByCategory($category) {

        return $this->mongoch->find(new ArrayToTweet(), array('text' => array('$in' => $this->filterByCategory($category))));

    }

    public function findbyCategoryInAnInterval($category, $initial, $final){

        return $this->mongoch->findInAnInterval($initial, $final, new ArrayToTweet(), array('text' => array('$in' => $this->filterByCategory($category))));

    }



}

}



?>