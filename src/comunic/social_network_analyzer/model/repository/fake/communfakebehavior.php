<?php

namespace comunic\social_network_analyzer\model\repository\fake {


    class CommunFakeBehavior {

        private $dados = array();

        public function delete($id) {

            unset($this->dados[$id]);
        }

        public function findById($id) { {

                if (\array_key_exists($id, $this->dados)) {
                    return $this->dados[$id];
                }

                throw new \Exception("Nao existe entidade com id = $id");
            }
        }

        public function insert($id, $entity) {
            $this->dados[$id] = $entity;
        }

        public function listAll() {
            return $this->dados;
        }

        public function update($id, $entity) {
            $this->dados[$id] = $entity;
        }

    }

}