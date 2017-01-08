<?php
  spl_autoload_register(function($class)
    {
        $folder = __dir__;
        $parts = explode('\\', $class);
        $path = implode("/",$parts) . '.php';
        
        if(file_exists($path))
        {
            require implode("/",$parts) . '.php';    
        }
        else
        {
            return false;
        }
    }
    );
    ?>