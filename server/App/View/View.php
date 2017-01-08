<?php
    namespace App\View;
    /**
     *View class
    */
    class View
    {
        /**
         *Contain path for view template
         *@var string 
        */
        protected $viewTemplate;
        
        /**
         *variable data
         *@var array
        */
        protected $varData;
        
        /**
         *Create view and set default values.
        */
        public function __construct()
        {
            $this->viewTemplate = "Default/json.jtp";
            $this->varData = [];
        }
        
        /**
         *Set view template
         *@param string $viewTemplate relative path to view template
        */
        public function setViewTemplate($viewTemplate)
        {
            $this->viewTemplate = $viewTemplate;
        }
        
        /**
         *Set variable
         *@param string $varName variable name
         *@param value $varVal value of variable
        */
        public function set($varName,$varVal)
        {
            $this->varData[$varName] = $varVal;
        }
        
        /**
         *Render the view with the template.
         *@param Response $response response object
        */
        public function render($response)
        {
            extract($this->varData);
            if (!file_exists($this->viewTemplate))
            {
                require $this->viewTemplate;    
            }
            else
            {
                throw new Exception("Cannot find view template");
            }
            
        }
    }
?>