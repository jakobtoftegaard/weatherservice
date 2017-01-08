<?php
    namespace App\Controller;
    use App\View\View;
    
    /**
     *Abstract controller class. Should be inherited by all Controllers.
    */
    abstract class Controller {
        
        /**
         *Request object
         *@var Request
        */
        public $request;
        
        /**
         *Response object
         *@var Response
        */
        public $response;
        
        /**
         *View object
         *@var View
        */
        private $view;
        
        /**
         *Constructor
         *@param Request $request
         *@param Request $response
        */
        public function __construct($request,$response)
        {
            $this->view = new View();
            $this->request = $request;
            $this->response = $response;
        }
        
        /**
         *Invoked before the action
        */
        public function beforeAction()
        {
            
        }
        
        /**
         *Invokes action and render
         *@param string action
        */
        public function invokeAction($action)
        {
            if(!method_exists($this,$action))
            {
                throw new \Exception("Cannot find action");
            }
            $this->$action();
            $this->render($this->response);
        }
        
        /**
         * Set key, value used by view
         * @param string $key
         * @param value $value 
        */
        public function set($key,$value)
        {
            $this->view->set($key,$value);
        }
        /**
         *Render view
        */
        public function render()
        {
            $this->view->render($this->response);
        }
    }
    
?>