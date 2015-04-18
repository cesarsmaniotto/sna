<?php


namespace comunic\social_network_analyzer\model\repository\fake {

    use comunic\social_network_analyzer\model\repository\IUsersRepository;
    
    /**
     * Description of userrepository
     *
     * @author jean
     */
    class UserRepository extends DiskRepository implements IUsersRepository {

         function __construct() {
            parent::__construct('users');
        }

    }

}