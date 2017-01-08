<?php
    namespace App\Common;
    /**
     * Envoke controllers and view based
    */
    class Dispatcher
    {
        /**
         * Dispatch request
         * @param Request request object
         * @param Response response object
        */
        public function dispatch(Request $request, Response $response)
        {
            $error = false;
            try
            {
                list($controller,$action,$extra) = Route::getInstance()->route($request,$response);
                if($controller == "")
                {
                    throw new Exception("No path specified");
                }
                $controllerName = "App\\Controller\\" . ucfirst($controller) . "Controller";
                try
                {
                    $controllerObj = new $controllerName($request,$response);
                }
                catch(\Exception $e)
                {
                    throw new \Exception("Controller does not exist");
                }
                $controllerObj->beforeAction();
                $controllerObj->invokeAction($action);    
                
            }
            catch(\Exception $e)
            {
                $error = true;
                $response->responseCode = 404;
                $response->title = "Cannot find request";
                $response->details = $e->getMessage();
            }
            catch(\Error $e)
            {
                print_r($e);
                $error = true;
            }
            if($error)
            {
                $controllerObj = new \App\Controller\ErrorController($request,$response);
                $controllerObj->beforeAction();
                $controllerObj->invokeAction("run");
            }
        }
    }
?>