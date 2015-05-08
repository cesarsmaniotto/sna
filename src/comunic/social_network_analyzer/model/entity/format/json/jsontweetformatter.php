<?php

namespace comunic\social_network_analyzer\model\entity\format\json{

    use \comunic\social_network_analyzer\model\entity\mappers\TweetToArray;

    class JsonTweetFormatter extends BasicObjectFormatter{

    public function toMap($obj){

        $funcCategoryToArray = new TweetToArray();

            $dados=$funcCategoryToArray($obj);
            unset($dados['_id']);
            $dados["id"] = $obj->getId();
            return $dados;

        return $funcTweetToArray($obj);

    }
}

}



?>