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
         * @param  $category \comunic\social_network_analyzer\model\entity\Category
         * @return void
         * @access public
         */
        public function insert($category);

        /**
         *
         *
         * @param  $category \comunic\social_network_analyzer\model\entity\Category
         * @return void
         * @access public
         */
        public function update($category);

        /**
         *
         *
         * @param $id int
         * @return void
         * @access public
         */
        public function delete($id);

        /**
         *
         *
         * @param $id int
         * @return \comunic\social_network_analyzer\model\entity\Category
         * @access public
         */
        public function findById($id);

        /**
         *
         *
         * @return array An array of Category's instances
         * @see \comunic\social_network_analyzer\model\entity\Category
         * @access public
         */
        public function listAll();
    }

} // end of ICategoriesRepository
?>
