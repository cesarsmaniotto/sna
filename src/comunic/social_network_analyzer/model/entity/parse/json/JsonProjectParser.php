<?php

namespace comunic\social_network_analyzer\model\entity\parse\json {

    use comunic\social_network_analyzer\model\entity\Project;


    class JsonProjectParser extends BasicObjectParser {


        protected function createObject($jsonproject){
            $project = new Project();

            if (isset($jsonproject->id)) {
                $project->setId($jsonproject->id);
            }

            if (isset($jsonproject->name)) {
                $project->setName($jsonproject->name);
            }

            if (isset($jsonproject->datasetsIds)) {

                $project->setDatasetsIds($jsonproject->datasetsIds);
            }

            return $project;
        }
    }

}