<?php

namespace comunic\social_network_analyzer\model\entity{


    class Paginator{

        private $objectList;
        private $count;
        private $page;
        private $amountPerPage;
        private $numberPages;

        public function __construct($objectList, $count, $page, $amountPerPage){
            $this->objectList = $objectList;
            $this->count = $count;
            $this->page = $page;
            $this->amountPerPage = $amountPerPage;
            $this->numberPages = \ceil($count / $amountPerPage);

        }

        public function getObjectList()
        {
            return $this->objectList;
        }

        public function setObjectList($objectList)
        {
            return $this->objectList = $objectList;
        }

        public function getCount()
        {
            return $this->count;
        }

        public function setCount($count)
        {
            return $this->count = $count;
        }

        public function getPage()
        {
            return $this->page;
        }

        public function setPage($page)
        {
            return $this->page = $page;
        }

        public function getAmountPerPage()
        {
            return $this->amountPerPage;
        }

        public function setAmountPerPage($amountPerPage)
        {
            return $this->amountPerPage = $amountPerPage;
        }

        public function getNumberPages()
        {
            return $this->numberPages;
        }

        public function setNumberPages($numberPages)
        {
            return $this->numberPages = $numberPages;
        }

    }


}




?>