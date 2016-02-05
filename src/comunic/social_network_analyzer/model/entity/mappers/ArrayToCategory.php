<?php

namespace comunic\social_network_analyzer\model\entity\mappers{


  use \comunic\social_network_analyzer\model\entity\Category;

  class ArrayToCategory{

    public function __invoke($arrayData){
      $category = new Category();

      if (isset($arrayData['id'])) {
        $category->setId($arrayData['id']);
      }else if (isset($arrayData['_id'])) {
        $category->setId((string) $arrayData['_id']);
      }

      if (isset($arrayData['name'])) {
       $category->setName($arrayData['name']);
     }

     if (isset($arrayData['keywords'])) {
       $category->setKeywords($arrayData['keywords']);
     }

     return $category;

   }


 }



}



?>