<?php


namespace comunic\social_network_analyzer\model\repository\fake {

    use comunic\social_network_analyzer\model\repository\ICategoriesRepository;

    /**
     * Description of categoriesrepository
     *
     * @author jean
     */
    class CategoriesRepository extends DiskRepository implements ICategoriesRepository {

      
        function __construct() {
            parent::__construct('categories');
        }

    }

}