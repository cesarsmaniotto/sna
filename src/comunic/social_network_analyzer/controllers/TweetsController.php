 <?php
use comunic\social_network_analyzer\model\entity\parse\csv\CSVTweetParser;
use comunic\social_network_analyzer\model\entity\parse\json\JsonTweetParser;
use comunic\social_network_analyzer\model\entity\format\json\JsonTweetFormatter;
use comunic\social_network_analyzer\model\entity\format\json\JsonPaginator;
use comunic\social_network_analyzer\model\entity\mappers\TweetToArray;
use comunic\social_network_analyzer\model\entity\format\csv\CSVTweetFormatter;


$tweetsFacade = $factory->instantiateTweets();

$restapp->post('/tweets/csv_to_json/:idDataset', function($idDataset) use($restapp, $tweetsFacade) {
    $parserCSV = new CSVTweetParser();
    $formatter = new JsonTweetFormatter();

    $tweets = $parserCSV->parse(json_decode($restapp->request()->getBody(),true)["values"]);

    $tweetsFacade->import($tweets, $idDataset);

});

$restapp->get('/tweets/json/:idDataset', function($idDataset) use($restapp, $tweetsFacade) {

    $params = $restapp->request()->params();

    if(isset($params['skip']) and isset($params['amount'])){

        $options = array(
            'skip' => intval($params['skip']),
            'amount' => intval($params['amount']),
            'sortBy' => isset($params['sortBy']) ? $params['sortBy'] : 'time',
            'direction' => isset($params['direction']) ? $params['direction'] : 'ASC'
        );

        if(isset($params['filter'])){

            switch ($params['filter']) {
                case 'byCategory':

                   echo $tweetsFacade->findByCategoryInAnInterval($idDataset, $params['idCategory'],new JsonPaginator(new TweetToArray()), $options);
                break;
                
                default:
                    # code...
                break;
            }

        }else{
            echo $tweetsFacade->listInAnInterval($idDataset,new JsonPaginator(new TweetToArray()), $options);
        }
    }

    
});

 $restapp->get('/tweets/csv/:idDataset', function($idDataset) use($restapp, $tweetsFacade) {

     $params = $restapp->request()->params();

         $options = array(
             'sortBy' => isset($params['sortBy']) ? $params['sortBy'] : 'time',
             'direction' => isset($params['direction']) ? $params['direction'] : 'ASC'
         );

         if(isset($params['filter'])){

             switch ($params['filter']) {
                 case 'byCategory':
                    $jsonResponse = ['values' => $tweetsFacade->findByCategory($idDataset, $params['idCategory'],new CSVTweetFormatter(),$options)];
                    echo \json_encode($jsonResponse);
                 break;
                 
                 default:
                     # code...
                 break;
             }

         }else{
             echo $tweetsFacade->listInAnInterval($idDataset,new JsonPaginator(new TweetToArray()), $options);
         }

     
 });

// $restapp->get('/tweets/json/listInAnInterval/:idDataset/:indPage/:amount', function($idDataset, $indPage,$amount) use($restapp, $tweetsFacade) {
//     echo $tweetsFacade->listInAnInterval($idDataset,new JsonPaginator(new TweetToArray()), $indPage, $amount);

// });

?>