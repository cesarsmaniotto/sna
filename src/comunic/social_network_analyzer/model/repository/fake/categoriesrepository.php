<?php


namespace comunic\social_network_analyzer\model\repository\fake {

    use comunic\social_network_analyzer\model\repository\ICategoriesRepository;

    /**
     * Description of categoriesrepository
     *
     * @author jean
     */
    class CategoriesRepository implements ICategoriesRepository {

        private $dados;
     

        function __construct() {
                $this->dados = new DiskRepository('catagories.fakedata');
        }

        
        public function delete($id) {
            $this->dados->delete($id);
        }

        public function findById($id) {
            return $this->dados->findById($id);
        }

        
        public function insert($category) {
            $this->dados->insert( $category);
        }

        public function listAll() {
            return $this->dados->listAll();
        }

        public function update($category) {
            $this->dados->update($category);
        }

    }

}