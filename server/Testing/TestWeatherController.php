<?php
    use PHPUnit\Framework\TestCase;
    use App\Controller\WeatherController;
    
    class TestWeatherController extends TestCase {
        public function testNoInput()
        {
            $request = \App\Common\Request::create(null,null,["REMOTE_ADDR" => "130.225.9.11","REQUEST_METHOD" => "GET"]);
            $controller = $this->prepare($request);
            $data = $controller->get_todays_weather();        
        }
        public function testGeoInput()
        {
            $request = \App\Common\Request::create(null,null,["REMOTE_ADDR" => "130.225.9.11","REQUEST_METHOD" => "GET"]);
            $request->params["latitude"] = "56.16";
            $request->params["longitude"] = "10.21";
            $controller = $this->prepare($request);
            $data = $controller->get_todays_weather();        
        }
        
        public function testAreakeyInput()
        {
            $request = \App\Common\Request::create(null,null,["REMOTE_ADDR" => "130.225.9.11","REQUEST_METHOD" => "GET"]);
            $request->params["areakey"] = "124594";
            $controller = $this->prepare($request);
            $data = $controller->get_todays_weather();        
        }
        
        
        public function prepare($request)
        {
            $controller = new App\Controller\WeatherController($request, new App\Common\Response);
            $controller->beforeAction();
            return $controller;
        }
    }
    ?>