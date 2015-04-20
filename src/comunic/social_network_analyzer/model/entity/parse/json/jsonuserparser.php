<?php

namespace comunic\social_network_analyzer\model\entity\parse\json {

    use comunic\social_network_analyzer\model\entity\parse\IObjectParser;
    use comunic\social_network_analyzer\model\entity\User;

    /**
     * Description of jsonobjectuserpaser
     *
     * @author jean
     */
    class JsonUserParser implements IObjectParser {

        public function parse($text) {

            $jsonUser = \json_decode($text);
            $user = new User();

            $user->setId($jsonUser->id);
            $user->setName($jsonUser->name);


            return $user;
        }

    }

}