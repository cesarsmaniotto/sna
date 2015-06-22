<?php

namespace comunic\social_network_analyzer\model\entity\parse\json {

    use comunic\social_network_analyzer\model\entity\parse\IObjectParser;
    use comunic\social_network_analyzer\model\entity\Project;


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

            if (isset($jsonproject->datasets)) {
                $jsonDatasetParser = new JsonDatasetParser();

                $arrayObj = array();

                for ($i=0; $i < \count($jsonproject->datasets); $i++) {
                    $arrayObj[]=$jsonDatasetParser->parse(\json_encode($jsonproject->datasets[$i]));
                }
                $project->setDatasets($arrayObj);
            }

            return $project;
        }

    }

}