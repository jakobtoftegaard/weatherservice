<?php
    namespace App\Controller;
    use \App\Controller\Controller;
    use \App\Model\AccuWeather;
    
    /**
     *Weather controller. Lookup weather
    */
    class WeatherController extends Controller
    {
        /**
         *Contains location model
         *@var Model
        */
        public $locationModel;
        
        /**
         *Contains weather model
         *@var Model
        */
        public $weatherModel;
        
        
        /**
         *Sets and contruct the models
        */
        public function beforeAction()
        {
            $this->locationModel = new AccuWeather();
            $this->weatherModel = $this->locationModel;
        }
        
        /**
         *Get todays weather
         *Require accuweather areakey, longtitude/latitude pair otherwise is ip used
        */
        public function get_todays_weather()
        {
            $params = $this->request->params;
            if(isset($params["areakey"]))
            {
                $areaKey = $params["areakey"];
                
            }
            elseif(isset($params["longitude"]) && isset($params["latitude"]))
            {
                $latitude = $params["latitude"];
                $longitude = $params["longitude"];
                $locationData = $this->locationModel->getLocationFromGeoPosition($latitude,$longitude);
                $areaKey = $locationData["areakey"];
            }
            else
            {
                $ip = $this->request->server["REMOTE_ADDR"];
                $locationData = $this->locationModel->getLocationByIp($ip);
                if($locationData["areakey"] == "")
                {
                    throw new \Exception("Cannot find location");
                }
                $areaKey = $locationData["areakey"];
            }
            $data = $this->weatherModel->getTodaysWeatherFromAreaKey($areaKey);
            $this->set("outputData",$data);
        }
    }
?>