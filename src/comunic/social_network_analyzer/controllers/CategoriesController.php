<?php
use comunic\social_network_analyzer\model\entity\parse\json\BasicObjectParser;
use comunic\social_network_analyzer\model\entity\format\json\BasicObjectFormatter;
use comunic\social_network_analyzer\model\entity\mappers\ArrayToCategory;
use comunic\social_network_analyzer\model\entity\mappers\CategoryToArray;

$categoryFacade = $factory->instantiateCategories();

$restapp->get('/categories/json', function() use ($categoryFacade) {

    echo $categoryFacade->listAll(new BasicObjectFormatter(new CategoryToArray()));
});

$restapp->get('/categories/json/:idProject/:id', function($idProject,$id) use ($categoryFacade) {

    echo $categoryFacade->findById($id, new BasicObjectFormatter(new CategoryToArray()));
});

$restapp->post('/categories/json/:projectId', function($projectId) use ($categoryFacade, $restapp) {

    echo $categoryFacade->insert($restapp->request()->getBody(),$projectId, new BasicObjectParser(new ArrayToCategory()));
    
});

$restapp->put('/categories/json/:idProject', function($idProject) use ($categoryFacade, $restapp) {

    echo $categoryFacade->update($restapp->request()->getBody(), new BasicObjectParser(new ArrayToCategory()),$idProject);
});

$restapp->delete('/categories/json/:idProject/:id', function($idProject, $id) use ($categoryFacade) {

    echo $categoryFacade->delete($id,$idProject);
    
});

?>