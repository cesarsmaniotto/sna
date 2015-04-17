<?php

/**
 * class IObjectFormatter
 * 
 */

namespace comunic\social_network_analyzer\model\entity\format {

    interface IObjectFormatter {
        /** Aggregations: */
        /** Compositions: */

        /**
         * 
         *
         * @param  obj 

         * @return string
         * @access public
         */
        public function format($obj);
    }

    // end of IObjectFormatter
}
?>
