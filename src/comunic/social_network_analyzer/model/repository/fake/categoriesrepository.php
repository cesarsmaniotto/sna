<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace comunic\social_network_analyzer\model\repository\fake {

    use comunic\social_network_analyzer\model\repository\ICategoriesRepository;

    /**
     * Description of categoriesrepository
     *
     * @author jean
     */
    class CategoriesRepository implements ICategoriesRepository {

        private $dados;

        public function __construct() {
            $this->dados = new CommunFakeBehavior();
        }

        public function delete($id) {
            $this->dados->delete($id);
        }

        public function findById($id) {
            return $this->dados->findById($id);
        }

        /**
         *
         *
         * @param  $category \comunic\social_network_analyzer\model\entity\Category
         * @return void
         * @access public
         */
        public function insert($category) {

            $this->dados->insert($id, $entity);
        }

        public function listAll() {
            
        }

        public function update($category) {
            
        }

//put your code here
    }

}