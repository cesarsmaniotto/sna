<?php
use comunic\social_network_analyzer\model\entity\parse\json\JsonDatasetParser;
use comunic\social_network_analyzer\model\entity\format\json\JsonDatasetFormatter;

$datasetFacade = $factory->instantiateDatasets();

$restapp->get('/datasets/json/:id', function($id) use ($datasetFacade) {
    echo $datasetFacade->findById($id, new JsonDatasetFormatter());
});

$restapp->get('/datasets/json', function() use ($datasetFacade) {
    echo $datasetFacade->listAll(new JsonDatasetFormatter());
});

$restapp->get('/datasets/json/filter_by_project/:idProject', function($idProject) use ($datasetFacade) {
    echo $datasetFacade->filterByProject($idProject, new JsonDatasetFormatter());
});

$restapp->post('/datasets/json/:projectId', function($projectId) use ($datasetFacade, $restapp) {
    echo $datasetFacade->insert($restapp->request()->getBody(), $projectId, new JsonDatasetParser());
});

$restapp->put('/datasets/json', function() use ($datasetFacade, $restapp) {
    echo $datasetFacade->update($restapp->request()->getBody(), new JsonDatasetParser());
});

$restapp->delete('/datasets/json/:id', function($id) use ($datasetFacade) {
    echo $datasetFacade->delete($id);
});

?>