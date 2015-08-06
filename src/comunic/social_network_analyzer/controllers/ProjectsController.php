<?php
use comunic\social_network_analyzer\model\entity\parse\json\JsonProjectParser;
use comunic\social_network_analyzer\model\entity\format\json\JsonProjectFormatter;

$projectFacade = $factory->instantiateProjects();

$restapp->get('/projects/json/:id', function($id) use ($projectFacade) {
    echo $projectFacade->findById($id, new JsonProjectFormatter());
});

$restapp->get('/projects/json', function() use ($projectFacade) {
    echo $projectFacade->listAll(new JsonProjectFormatter());
});

$restapp->post('/projects/json', function() use ($projectFacade, $restapp) {
    echo $projectFacade->insert($restapp->request()->getBody(), new JsonProjectParser());
});

$restapp->put('/projects/json', function() use ($projectFacade, $restapp) {
    echo $projectFacade->update($restapp->request()->getBody(), new JsonProjectParser());
});

$restapp->delete('/projects/json/:id', function($id) use ($projectFacade) {
    echo $projectFacade->delete($id);
});


?>