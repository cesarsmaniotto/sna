<?php

namespace comunic\social_network_analyzer\model\entity\parse\json {

    use comunic\social_network_analyzer\model\entity\parse\IObjectParser;
    use comunic\social_network_analyzer\model\entity\Project;

    /**
     * Description of jsonobjectprojectpaser
     *
     * @author jean
     */
    class JsonProjectParser implements IObjectParser {

        public function parse($text) {

            $jsonproject = \json_decode($text);
            $project = new Project();

            if (isset($jsonproject->id)) {
                $project->setId($jsonproject->id);
            }

            if (isset($jsonproject->name)) {
                $project->setName($jsonproject->name);
            }

            return $project;
        }

    }

}