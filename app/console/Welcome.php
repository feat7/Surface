<?php

namespace app\console; 

class Welcome{

    /**
     * Default method. This method will be called if no args are given
     */
    public function run($args){
        echo "Hello World!";
    }

    /**
     * Custom method. Has to be specified in command as "./surface welcome another"
     */

     public function another($args){
         echo "Another Method";
     }
}