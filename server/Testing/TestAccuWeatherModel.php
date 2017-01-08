<?php
    use PHPUnit\Framework\TestCase;
    use App\Model\AccuWeather;
    use App\Common\Configure;
    class TestAccuWeatherModel extends TestCase {
        /**
        * @expectedException        Exception
        * @expectedExceptionMessage Weather request
        */
        public function testWrongWeatherKey()
        {
            $this->prepare();
            $model = new App\Model\AccuWeather;
            $response = $model->getTodaysWeatherFromAreaKey("random_key");
        }
        public function testCorrectWeatherKey()
        {
            $this->prepare();
            $model = new App\Model\AccuWeather;
            $response = $model->getTodaysWeatherFromAreaKey("124594");
            $this->assertTrue(isset($response["temperature"]));
        }
        
        /**
        * @expectedException        Exception
        * @expectedExceptionMessage Empty response
        */
        public function testLocationBasedOnIpWrongIp()
        {
            $this->prepare();
            $model = new App\Model\AccuWeather;
            $location = $model->getLocationByIp("127.0.0.1");
        }
        
        /**
        * @expectedException        Exception
        * @expectedExceptionMessage Weather request failed
        */
        public function testLocationBasedOnIpWrongIp2()
        {
            $this->prepare();
            $model = new App\Model\AccuWeather;
            $location = $model->getLocationByIp("127.0.0.a");
        }
        
        public function testLocationBasedOnIpCorrect()
        {
            $this->prepare();
            $model = new App\Model\AccuWeather;
            $location = $model->getLocationByIp("130.225.9.11"); //Aarhus university ip
            $this->assertEquals("Aarhus",$location["areaName"]);

        }
        public function testGeoPositionCorrect()
        {
            $this->prepare();
            $model = new App\Model\AccuWeather;
            $location = $model->getLocationFromGeoPosition("56.16","10.21");
            $this->assertEquals("Aarhus",$location["areaName"]);
        }
        /**
        * @expectedException        Exception
        * @expectedExceptionMessage Weather request failed
        */
        public function testGeoPositionWrong()
        {
            $this->prepare();
            $model = new App\Model\AccuWeather;
            $location = $model->getLocationFromGeoPosition("56.16a","10.21");
            $this->assertEquals("Aarhus",$location["areaName"]);
        }
        
        /**
        * @expectedException        Exception
        * @expectedExceptionMessage Weather request failed
        */
        public function testGeoPositionWrong2()
        {
            $this->prepare();
            $model = new App\Model\AccuWeather;
            $location = $model->getLocationFromGeoPosition("156.16","10.21");
            $this->assertEquals("Aarhus",$location["areaName"]);
        }
        
        private function prepare()
        {
            
        }
    }
?>