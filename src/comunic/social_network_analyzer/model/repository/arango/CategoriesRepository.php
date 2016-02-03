<?php

namespace comunic\social_network_analyzer\model\repository\arango{

	use comunic\social_network_analyzer\model\repository\ICategoriesRepository;
	use comunic\social_network_analyzer\model\entity\mappers\ArrayToCategory;
	use comunic\social_network_analyzer\model\entity\mappers\CategoryToArray;

	class CategoriesRepository extends AbstractArangoRepository implements ICategoriesRepository{
		
		function __construct(){
			parent::__construct();

			$this->entityName = "categories";

		}

		public function insert($category, $projectId){

			$wordsRepo = new WordsRepository();

			$words = $wordsRepo->listAll();

			

			$catId = $this->graphHandler->createVertex($category, new CategoryToArray(), $this->entityName);

			$this->graphHandler->saveEdge($this->buildId("projects",$projectId),$catId,"projects_categories_belong","projects_categories_belong");

			if(!empty($words)){
				$edges = array();
				$matchWords = $category->matchWithKeywords($words);
				foreach ($matchWords as $word){

					$edges[] = $this->graphHandler->createEdge($catId,"words/".$word->getId(),"categories_words_contains");

				}

				$this->graphHandler->import("categories_words_contains",$edges);
			}
			
		}

		public function update($category){
			$id = $this->buildId($this->entityName, $category->getId());
			return $this->graphHandler->updateVertex($id, $category, new CategoryToArray());
		}

		public function filterByProject($projectId){
			$projectId = $this->buildId("projects", $projectId);

			$edges = $this->graphHandler->getEdges($projectId,"projects_categories_belong");

			$categories = array();
			foreach ($edges->getAll() as $edge) {
				$categories[] = $this->graphHandler->getVertex($edge->getTo() ,new ArrayToCategory());
			}

			return $categories;
		}

		public function delete($id){
			$id = $this->buildId($this->entityName, $id);
			return $this->graphHandler->deleteVertex($id);
		}

		public function listAll(){

			return $this->graphHandler->listVertex($this->entityName, new ArrayToCategory());
		}

		public function findById($id){
			$id = $this->buildId($this->entityName, $id);
			return $this->graphHandler->getVertex($id, new ArrayToCategory());

		}

	}

	


}

?>