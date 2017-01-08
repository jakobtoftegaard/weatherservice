<?php
   include_once "Config/config.php";
   include_once "Common/Request.php";
   include_once "Common/Response.php";
   include_once "Common/Dispatcher.php";
   include_once "autoload.php";

   
   use App\Common\Response;
   use App\Common\Request;
   use App\Common\Dispatcher;
   use App\Common\Configure;
   Configure::init();
   Configure::write("Weather.key","8Pp0cmntA0qm5ZxnPz48GLa9GlNgJBtu");
   
   $dispatcher = new Dispatcher();
   $dispatcher->dispatch(Request::create(),new Response());
   
?>