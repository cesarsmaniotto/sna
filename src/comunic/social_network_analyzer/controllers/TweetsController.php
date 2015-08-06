<?php
use comunic\social_network_analyzer\model\entity\parse\csv\CSVTweetParser;
use comunic\social_network_analyzer\model\entity\parse\json\JsonTweetParser;
use comunic\social_network_analyzer\model\entity\format\json\JsonTweetFormatter;
use comunic\social_network_analyzer\model\entity\format\json\JsonPaginator;
use comunic\social_network_analyzer\model\entity\mappers\TweetToArray;

$tweetsFacade = $factory->instantiateTweets();

$restapp->post('/tweets/csv_to_json/:idDataset', function($idDataset) use($restapp, $tweetsFacade) {
    $parserCSV = new CSVTweetParser();
    $formatter = new JsonTweetFormatter();

    $tweets = $parserCSV->parse(json_decode($restapp->request()->getBody(),true)["values"]);

    $jsonTweets = $formatter->format($tweets);

    $tweetsFacade->insert($jsonTweets, $idDataset,new JsonTweetParser());

});

$restapp->get('/tweets/json/:idDataset', function($idDataset) use($restapp, $tweetsFacade) {

    $params = $restapp->request()->params();

    if(isset($params['skip']) and isset($params['amount'])){
        $skip = intval($params['skip']);
        $amount = intval($params['amount']);

        if(isset($params['filter'])){

            switch ($params['filter']) {
                case 'byCategory':
                echo $tweetsFacade->findByCategoryInAnInterval($idDataset, $params['idCategory'],new JsonPaginator(new TweetToArray()), $skip, $amount);
                break;
                
                default:
                    # code...
                break;
            }

        }else{
            echo $tweetsFacade->listInAnInterval($idDataset,new JsonPaginator(new TweetToArray()), $skip, $amount);
        }
    }

    
});

// $restapp->get('/tweets/json/listInAnInterval/:idDataset/:indPage/:amount', function($idDataset, $indPage,$amount) use($restapp, $tweetsFacade) {
//     echo $tweetsFacade->listInAnInterval($idDataset,new JsonPaginator(new TweetToArray()), $indPage, $amount);

// });

?>