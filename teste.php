<h1>Teste</h1>


<?php
require_once 'autoload.php';

ini_set('display_errors', true);

use \comunic\social_network_analyzer\model\repository\mongo\MongoCollectionHandler;



class Pessoa{
    public $id;
    public $nome;
    public $idade;
}

$ps=new Pessoa();

// $ps->id="553fe53056f6e189158b4567";
$ps->nome="Dilminha";
$ps->idade=60;

$mongoch = new MongoCollectionHandler('t');

class ToArray{

    public function __invoke($obj){



      $arrData=array();
      $arrData['_id']=new \MongoId($obj->id);
      $arrData['nome']=$obj->nome;
      $arrData['idade']=$obj->idade;
      return  $arrData;


  }
}


class ToObject{

    public function __invoke($arrData){

        $obj=new Pessoa();
       // $mId=$arrData["_id"];

        $obj->id=$arrData["_id"]->{'$id'};
        $obj->nome=$arrData['nome'];
        $obj->idade=$arrData['idade'];
        return  $obj;

    }
}


$mongoch->save($ps,new ToArray());
$lista=$mongoch->find(new ToObject());


echo var_dump($lista);
?>

