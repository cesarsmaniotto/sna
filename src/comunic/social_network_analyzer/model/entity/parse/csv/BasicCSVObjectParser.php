<?php

namespace comunic\social_network_analyzer\model\entity\parse\csv{

    use comunic\social_network_analyzer\model\entity\parse\IObjectParser;

    abstract class BasicCSVObjectParser implements IObjectParser{


        public function parse($csvData){
            $csvData = \trim($csvData);
            $csvDataArray = \explode("\n", $csvData);

            $fieldNames = \str_getcsv(\trim($csvDataArray[0]), "|");

            unset($csvDataArray[0]);

            $objects = array();

            foreach ($csvDataArray as $csvRow) {

                $csvRowArray = \str_getcsv(\trim($csvRow), "|");

                $rowDataMap = array();

                    if (\count($fieldNames) == \count($csvRowArray)) {

                        for ($i = 0; $i < \count($fieldNames); $i++) {
                            $f_name = $fieldNames[$i];
                            $csv_fd_data = $csvRowArray[$i];
                            $rowDataMap[$f_name] = $csv_fd_data;
                        }

                        $objects[] = $this->arrayToObject($rowDataMap);
                    }

            }

            return $objects;



        }

        abstract protected function arrayToObject($arrayData);


    }





}


?>