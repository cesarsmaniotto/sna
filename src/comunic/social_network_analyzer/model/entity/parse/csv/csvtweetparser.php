<?php

namespace comunic\social_network_analyzer\model\entity\parse\csv {

    use comunic\social_network_analyzer\model\entity\parse\IObjectParser;
    use comunic\social_network_analyzer\model\entity\Tweet;

    class CSVTweetParser implements IObjectParser {

        public function parse($cvsData) {


            function parseTeste($arrayData) {

                $tweet = new Tweet();

                $tweet->setText($arrayData['text']);
                $tweet->setToUserId($arrayData['to_user_id']);
                $tweet->setFromUser($arrayData['from_user']);
                $tweet->setIdTweet($arrayData['id']);
                $tweet->setFromUserId($arrayData['from_user_id']);
                $tweet->setIsoLanguageCode($arrayData['iso_language_code']);
                $tweet->setSource($arrayData['source']);
                $tweet->setProfileImageUrl($arrayData['profile_image_url']);
                $tweet->setGeoType($arrayData['geo_type']);
                $tweet->setGeoCoordinates0($arrayData['geo_coordinates_0']);
                $tweet->setGeoCoordinates1($arrayData['geo_coordinates_1']);
                $tweet->setCreatedAt($arrayData['created_at']);
                $tweet->setTime($arrayData['time']);

                return $tweet;
            }

            $cvsData = \trim($cvsData);
            $cvsDataArray = \explode("\n", $cvsData);

            $fieldNames = \str_getcsv(\trim($cvsDataArray[0]), "|");
            unset($cvsDataArray[0]);

            $csvData = array();

            foreach ($cvsDataArray as $csvRow) {

                $csvRowArray = \str_getcsv(\trim($csvRow), "|");


                $rowDataMap = array();
                for ($i = 0; $i < \count($fieldNames); $i++) {
                    $f_name = $fieldNames[$i];
                    $csv_fd_data = $csvRowArray[$i];
                    $rowDataMap[$f_name] = $csv_fd_data;
                }

                $csvData[] = parseTeste($rowDataMap);
            }


            return $csvData;
        }

    }

}