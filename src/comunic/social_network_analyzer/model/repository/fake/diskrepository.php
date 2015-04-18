<?php

namespace comunic\social_network_analyzer\model\repository\fake {


    class DiskRepository {

        private $data;
        private $dataFile;

        public function __construct($dataFile) {
            $this->dataFile = __DIR__ . DIRECTORY_SEPARATOR . $dataFile;
        }

        public function delete($id) {
            $this->loadData();
            unset($this->data[$id]);
            $this->storeData();
        }

        private function loadData() {

            if (\file_exists($this->dataFile)) {
                $this->data = \file_get_contents($this->dataFile);
                $this->data = \unserialize($this->data);
            } else {
                $this->data = array();
            }
        }

        private function storeData() {
            \file_put_contents($this->dataFile, \serialize($this->data));
        }

        public function findById($id) { {
                $this->loadData();
                if (\array_key_exists($id, $this->data)) {
                    return $this->data[$id];
                }

                throw new \Exception("Nao existe entidade com id = $id");
            }
        }

        public function insert($entity) {
            $this->loadData();
            $id = 0;

            if (\count($this->data) != 0) {

                $entityKeys = \array_keys($this->data);
                \sort($entityKeys);
                $id = \array_pop($entityKeys) + 1;
            }


            $entity->setId($id);
            $this->data[$id] = $entity;
            $this->storeData();
        }

        public function listAll() {
            $this->loadData();
            return $this->data;
        }

        public function update($entity) {
            $this->loadData();
            $id = $entity->getId();
            $this->findById($id);
            $this->data[$id] = $entity;
            $this->storeData();
        }

    }

}