<?php
use comunic\social_network_analyzer\model\entity\parse\json\BasicObjectParser;
use comunic\social_network_analyzer\model\entity\format\json\BasicObjectFormatter;
use comunic\social_network_analyzer\model\entity\mappers\ArrayToProject;
use comunic\social_network_analyzer\model\entity\mappers\ProjectToArray;

use comunic\social_network_analyzer\model\entity\format\json\JsonProjectFormatter;

$projectFacade = $factory->instantiateProjects();

$restapp->get('/projects/json/:id', function($id) use ($projectFacade) {
    echo $projectFacade->findById($id, new JsonProjectFormatter());
});

$restapp->get('/projects/json', function() use ($projectFacade) {
    echo $projectFacade->listAll(new JsonProjectFormatter());
});

$restapp->post('/projects/json', function() use ($projectFacade, $restapp) {
    echo $projectFacade->insert($restapp->request()->getBody(), new BasicObjectParser(new ArrayToProject()));
});

$restapp->put('/projects/json', function() use ($projectFacade, $restapp) {
    echo $projectFacade->update($restapp->request()->getBody(), new BasicObjectParser(new ArrayToProject()));
});

$restapp->delete('/projects/json/:id', function($id) use ($projectFacade) {
    echo $projectFacade->delete($id);
});


?>