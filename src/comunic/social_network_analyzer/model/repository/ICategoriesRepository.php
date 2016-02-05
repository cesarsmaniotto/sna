<?php

namespace comunic\social_network_analyzer\model\repository {

    /**
     * class ICategoriesRepository
     *
     */
    interface ICategoriesRepository {
        /** Aggregations: */
        /** Compositions: */

        /**
         *
         *
         * @param  \comunic\social_network_analyzer\model\entity\Category $category
         * @return void
         * @access public
         */
        public function insert($category, $projectId);

        /**
         *
         *
         * @param   \comunic\social_network_analyzer\model\entity\Category $category
         * @return void
         * @access public
         */
        public function update($category, $projectId);

        /**
         *
         *
         * @param $id int
         * @return void
         * @access public
         */
        public function delete($id, $projectId);

        /**
         *
         *
         * @param  int $id
         * @return \comunic\social_network_analyzer\model\entity\Category
         * @access public
         */
        public function findById($id, $projectId);

        /**
         *
         *
         * @return array An array of Category's instances
         * @see \comunic\social_network_analyzer\model\entity\Category
         * @access public
         */
        public function listAll($projectId);


    }

} // end of ICategoriesRepository
?>
