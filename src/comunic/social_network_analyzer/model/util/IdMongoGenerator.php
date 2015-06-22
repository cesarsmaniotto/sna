<?php

namespace comunic\social_network_analyzer\model\util{

class IdMongoGenerator implements IdGenerator{

    public function __invoke(){
        $id = new \MongoId();

        return $id->{'$id'};
    }


}

}

?>