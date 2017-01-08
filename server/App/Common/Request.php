<?php
namespace App\Common;

/**
 * Placeholder containing request data 
*/
class Request
{
    
    /**
     *url 
     *@var string
    */
    public $url;
    /**
     *Http get parameters
     *@var array
    */
    public $query;
    
    
    /**
     * Http post data
     *@var array
    */
    public $post;
    
    /**
     *Http method
     *@var string
    */
    public $requestMethod;

    /**
     *Params extracted from router
     *@var array
    */
    public $params;
   
    /**
     *Server paramters
     *@var array
    */
    public $server;
   /**
    * Create a new request
    * @param $query array
    * @param $post array
    * @param $server array
   */
    public static function create($query = null,$post = null,$server = null)
    {
        if(!isset($query))
        {
            $query = $_GET;
        }
        if(!isset($post))
        {
            $post = $_POST;
        }
        if(!isset($server))
        {
            $server = $_SERVER;
        }
        $request = new Request();
        $request->query = $query;
        $request->post = $post;
        $request->server = $server;
        $request->requestMethod = $server["REQUEST_METHOD"];
        return $request;
    }
}
?>