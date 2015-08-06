<?php

namespace comunic\social_network_analyzer\model\repository\arango{

	use comunic\social_network_analyzer\model\repository\IRepositoryFactory;

	class ArangoRepository implements IRepositoryFactory{

		public function instantiateTweet(){

			return new TweetsRepository();
		}
		public function instantiateUser(){
			
		}

		public function instantiateCategory(){

			return new CategoriesRepository();
		}

		public function instantiateProject(){

			return new ProjectsRepository();

		}
		public function instantiateDataset(){

			return new DatasetsRepository();
		}

	}


}



?>