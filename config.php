<?php

	spl_autoload_register(function($class_name){

    $filename =  "class" . DIRECTORY_SEPARATOR . $class_name . ".php"; //->    class/nomeDaClasse.php

    if (file_exists(($filename))) {
        require_once($filename);
    }

});
?>