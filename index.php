<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require_once './src/autoload.php';

        use comunic\social_network_analyzer\model\facade\FacadeFactory;
        use comunic\social_network_analyzer\model\repository\fake\FakeRepository;

        $repositoryFactory = new FakeRepository();
        $ffact = new FacadeFactory($repositoryFactory);

        $catF = $ffact->instantiateCategories();
        $twF = $ffact->instantiateTweets();
        $usF = $ffact->instantiateUsers();

        echo var_dump($catF);
        echo var_dump($twF);
        echo var_dump($usF);
      

        echo "fim <br>";
        ?>
    </body>
</html>
