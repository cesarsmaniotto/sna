<?php

namespace comunic\social_network_analyzer\model\entity\parse\json {

    use comunic\social_network_analyzer\model\entity\Project;


    class JsonProjectParser extends BasicObjectParser {


        protected function createObject($arrayData){
            $project = new Project();

            if (isset($arrayData['id'])) {
                $project->setId($arrayData['id']);
            }

            if (isset($arrayData['name'])) {
                $project->setName($arrayData['name']);
            }

            if (isset($arrayData['datasets'])) {
                $project->setName($arrayData['datasets']);
            }

            return $project;
        }
    }

}