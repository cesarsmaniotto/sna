<?php
use comunic\social_network_analyzer\model\entity\parse\json\JsonCategoryParser;
use comunic\social_network_analyzer\model\entity\format\json\JsonCategoryFormatter;

$categoryFacade = $factory->instantiateCategories();

$restapp->get('/categories/json', function() use ($categoryFacade) {

    echo $categoryFacade->listAll(new JsonCategoryFormatter());
});

$restapp->get('/categories/json/:id', function($id) use ($categoryFacade) {

    echo $categoryFacade->findById($id, new JsonCategoryFormatter());
});

$restapp->post('/categories/json/:projectId', function($projectId) use ($categoryFacade, $restapp) {

    echo $categoryFacade->insert($restapp->request()->getBody(),$projectId, new JsonCategoryParser());
    
});

$restapp->get('/categories/json/filter_by_project/:idProject', function($idProject) use ($categoryFacade) {
    echo $categoryFacade->filterByProject($idProject, new JsonCategoryFormatter());
});

$restapp->put('/categories/json', function() use ($categoryFacade, $restapp) {

    echo $categoryFacade->update($restapp->request()->getBody(), new JsonCategoryParser());
});

$restapp->delete('/categories/json/:id', function($id) use ($categoryFacade) {

    echo $categoryFacade->delete($id);
    
});

?>