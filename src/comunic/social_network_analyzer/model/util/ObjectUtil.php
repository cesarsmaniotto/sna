<?php

namespace comunic\social_network_analyzer\model\util{

  class ObjectUtil{

    public static function object_to_array($obj)
    {
     
     if (is_object($obj))
     {
       $result = array();
       $cls = new \ReflectionClass($obj);
       $props = $cls->getProperties();
       foreach ($props as $prop)
       {
        $prop->setAccessible(true);

        if(\is_array($prop->getValue($obj))){
          

          foreach ($prop->getValue($obj) as $item) {
            $result[$prop->getName()] = array(self::object_to_array($item));
          }

        }else{
          $result[$prop->getName()] = $prop->getValue($obj);
        }
        
        $prop->setAccessible(true);
      }
      return $result;
    }
    return $obj;
  }

}

}

?>
