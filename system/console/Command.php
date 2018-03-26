<?php

namespace system\console; 

use app\console; 

class Command{

    public function __construct($argv) {
        array_shift($argv);
        $className = ucwords($argv[0]);
        array_shift($argv);
        if(empty($argv)){
            $methodName = "run";
        }
        else{
            $methodName = $argv[0];
            array_shift($argv);
        }

        try{
            $this->run($className,$methodName, $argv);
        }catch(Exception $e){
            
        }
    }
    
    public function run($className, $methodName, $args){

		$objectName = '\app\console\\'.$className;

		if(method_exists($objectName, $methodName)) {
            
            $object = new $objectName;
            $object->{$methodName}($args);
            
        }
        else{
            echo "Method not found";
        }
    }
}