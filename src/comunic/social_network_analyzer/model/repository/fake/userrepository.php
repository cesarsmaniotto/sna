<?php


namespace comunic\social_network_analyzer\model\repository\fake {

    use comunic\social_network_analyzer\model\repository\IUsersRepository;
    use comunic\social_network_analyzer\model\entity\User;

    /**
     * Description of userrepository
     *
     * @author jean
     */
    class UserRepository implements IUsersRepository {

        public function delete($id) {
            
        }

        public function findById($id) {
            return new User();
        }

        public function insert($user) {
            
        }

        public function listAll() {
            return array(new User(),new User());
        }

        public function update($user) {
            
        }


    }

}