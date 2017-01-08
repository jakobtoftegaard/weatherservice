<?php
    namespace App\Common;
    
    /**
     *Route class extract routing information from requst
     *Singleton instance
    */
    class Route
    {
        /**
         *contain the singleton object
         *@var Route
        */
        private static $_instance;
    
        /**
         *Extract routing information from request
         *@param Request
         *@param Response
         *@return array with strings with controller,action and array with params
        */
        public function route(Request $request,Response $response)
        {
            $controller = "";
            
            /**
             *Default action is index
            */
            $action = "index";
            $url = $request->query;
            if(isset($url["path"]))
            {
                $path = $url["path"];
                $pathArray = explode('/',$path);
                if(isset($pathArray[0]))
                    $controller = urldecode($pathArray[0]);
                if(isset($pathArray[1]))
                    $action = urldecode($pathArray[1]);
            }
            $params = [];
            foreach($url as $key => $value)
            {
                if(strcmp($key,"path"))
                {
                    $params[$key] = $value;
                }
            }
            $request->params = $params;
            return [$controller,$action,$extra];
        }
        
        /**
         *Get singleton instance
         *@return Routes
        */
        public static function getInstance()
        {
            if(!isset(self::$_instance))
                self::$_instance = new Route();
            return self::$_instance;
        }
    }
?>