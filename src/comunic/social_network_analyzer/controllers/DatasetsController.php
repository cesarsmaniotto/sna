<?php
use comunic\social_network_analyzer\model\entity\parse\json\BasicObjectParser;
use comunic\social_network_analyzer\model\entity\format\json\BasicObjectFormatter;
use comunic\social_network_analyzer\model\entity\mappers\ArrayToDataset;
use comunic\social_network_analyzer\model\entity\mappers\DatasetToArray;

$datasetFacade = $factory->instantiateDatasets();

$restapp->get('/datasets/json/:idProject/:id', function($idProject ,$id) use ($datasetFacade) {
    echo $datasetFacade->findById($id, $idProject, new BasicObjectFormatter(new DatasetToArray()));
});

$restapp->get('/datasets/json', function() use ($datasetFacade) {
    echo $datasetFacade->listAll(new BasicObjectFormatter(new DatasetToArray()));
});

$restapp->post('/datasets/json/:projectId', function($projectId) use ($datasetFacade, $restapp) {
    echo $datasetFacade->insert($restapp->request()->getBody(), $projectId, new BasicObjectParser(new ArrayToDataset()));
});

$restapp->put('/datasets/json', function() use ($datasetFacade, $restapp) {
    echo $datasetFacade->update($restapp->request()->getBody(), new BasicObjectParser(new ArrayToDataset()));
});

$restapp->delete('/datasets/json/:id', function($id) use ($datasetFacade) {
    echo $datasetFacade->delete($id);
});

?>