<?php

    namespace App\Controller;
    use \App\Controller\Controller;

    /**
     *Error controller. Control error handling
    */
    class ErrorController extends Controller
    {
        public function run()
        {
            if($this->response->responseCode == 200)
            {
                $this->response->responseCode = 500;
                $this->response->title = "Unknown error";
                $this->response->details = "An unknown error";
            }
        }
    }
?>