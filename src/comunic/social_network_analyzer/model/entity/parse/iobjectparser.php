<?php

/**
 * class IObjectParser
 * 
 */

namespace comunic\social_network_analyzer\model\entity\parse {

    interface IObjectParser {
        /** Aggregations: */
        /** Compositions: */

        /**
         * 
         *
         * @param string text 

         * @return void
         * @access public
         */
        public function parse($text);
    }

    // end of IObjectParser
}
?>
