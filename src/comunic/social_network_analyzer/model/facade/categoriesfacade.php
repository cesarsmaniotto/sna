<?php

namespace comunic\social_network_analyzer\model\facade {

    use comunic\social_network_analyzer\model\repository\ICategoriesRepository;

    /**
     * class CategoriesFacade
     *
     */
    class CategoriesFacade {
        /** Aggregations: */

        /** Compositions: */
        /*         * * Attributes: ** */

        private $repository;

        /**
         * @param comunic\social_network_analyzer\model\repository\ICategoriesRepository $repository
         * @access public
         */
        public function __construct($repository) {
            $this->repository = $repository;
        }

        /**
         *
         *
         * @param string $categorie_text
         * @param  \comunic\social_network_analyzer\model\entity\parse\IObjectParser $parser
         * @return void
         * @access public
         */
        public function insert($categorie_text, $parser) {
            $category = $parser->parse($categorie_text);
            $repository->insert($category);
        }

// end of member function insert

        /**
         *
         *
         * @param  string $categorie_text
         * @param  \comunic\social_network_analyzer\model\entity\parse\IObjectParser $parser
         * @return void
         * @access public
         */
        public function update($categorie_text, $parser) {
            $category = $parser->parse($categorie_text);
            $repository->update($category);
        }

// end of member function update

        /**
         *
         *
         * @param int $id
         * @param  \comunic\social_network_analyzer\model\entity\format\IObjectFormatter $fmt
         * @return string
         * @access public
         */
        public function findById($id, $fmt) {
            return $fmt->format($repository->findById($id));
        }

// end of member function findById

        /**
         *
         *
         * @param  int $id
         * @return void
         * @access public
         */
        public function delete($id) {
            $repository->delete($id);
        }

// end of member function delete

        /**
         *
         *
         * @param  \comunic\social_network_analyzer\model\entity\format\IObjectFormatter $fmt
         * @return string
         * @access public
         */
        public function listAll($fmt) {
            return $fmt->format($repository->listAll());
        }

// end of member function listAll
    }

} // end of CategoriesFacade
?>
