<?php
namespace App\Common;

/**
 *Response class
*/
class Response
{
    public $responseCode;
    public $title;
    public $details;
    public function __construct()
    {
        $this->responseCode = 200;
        $this->title = "OK";
        $this->details = "All is ok";
    }
}
?>