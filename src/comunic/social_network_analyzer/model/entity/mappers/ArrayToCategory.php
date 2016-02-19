<?php

namespace comunic\social_network_analyzer\model\entity\mappers{


  use \comunic\social_network_analyzer\model\entity\Category;

  class ArrayToCategory{

    public function __invoke($arrayData){
      $category = new Category();

      if (isset($arrayData['id'])) {
        $category->setId($arrayData['id']);
      }

      if (isset($arrayData['name'])) {
       $category->setName($arrayData['name']);
     }

     if (isset($arrayData['keywords'])) {
       $category->setKeywords($arrayData['keywords']);
     }

     if (isset($arrayData['color'])) {
       $category->setColor($arrayData['color']);
     }

     return $category;

   }


 }



}



?>