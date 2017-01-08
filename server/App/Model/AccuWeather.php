<?php
    namespace App\Model;
    use App\Common\Configure;
    
    /**
     * AccuWeather model. Communicate with the accuweather api
     * @link http://developer.accuweather.com/
    */
    class AccuWeather extends Weather
    {
        
        /**
         *Performs request to the accuweather api
         *@param array request should contain service, action and params
         *@return response as JSON object 
        */
        protected function performRequest($request)
        {
            $apikey = Configure::read("Weather.key");
            $serviceUrl = "http://dataservice.accuweather.com/";
            $version = "v1";
            $service = $request["service"];
            $action = $request["action"];
            $params = $request["params"];
            $params["apikey"] = $apikey;
            $requestUrl = $serviceUrl . $service .
                         "/" . $version .
                         "/" . $action . "?" .
                         http_build_query($params);
            try
            {
                $response = file_get_contents($requestUrl);
                
            }
            catch(\Exception $e)
            {
                throw new \Exception("Weather request failed");
            }
            $jsonData = json_decode($response);
            
            if(empty($jsonData))
            {
                throw new \Exception("Empty response");
            }
            return $jsonData;            
        }
        
        /**
         *Get locationn data based on ip
         *@param string ip address
         *@return array with position data
        */
        public function getLocationByIp($ip)
        {
            $request = [];
            $request["service"] = "locations";
            $request["action"] = "cities/ipaddress";
            $request["params"] = ["q" => $ip];
            $JSONdata = $this->performRequest($request);
            
            $output = $this->extractLocationData($JSONdata);
            return $output;
        }
        
        /**
         *Get location data based on geoposition
         *@param string $latitude
         *@param string $longitude
         *@return array with position data
        */
        public function getLocationFromGeoPosition($latitude,$longitude)
        {
            $request = [];
            $request["service"] = "locations";
            $request["action"] = "cities/geoposition/search";
            $request["params"] = ["q" => $latitude . "," . $longitude];
            $JSONdata = $this->performRequest($request);
            $output = $this->extractLocationData($JSONdata);
            return $output;
        }
        
        /**
         *Helper function for extracting location data
         *@return array with position data
         *@param Object json object with position data
        */
        private function extractLocationData($JSONdata)
        {
            $output = [];
            $output["areakey"] = $JSONdata->Key;
            $output["areaName"] = $JSONdata->EnglishName;
            $output["areaGeoPosition"] = ["latitude" => $JSONdata->GeoPosition->Latitude,
                                          "longitude" => $JSONdata->GeoPosition->Longitude];
            return $output;
        }
        
        /**
         *Get today weether from area key
         *@param string $areaKey accuweather area key
         *@return array todays weather
        */
        public function getTodaysWeatherFromAreaKey($areaKey)
        {
            $request = [];
            $request["service"] = "forecasts";
            $request["action"] = "daily/1day/" . $areaKey;
            $request["params"] = ["metric" => "true"];
            $JSONdata = $this->performRequest($request);
            $weatherData = ["temperature" => ["low" => $JSONdata->DailyForecasts[0]->Temperature->Minimum->Value,
                                              "high" => $JSONdata->DailyForecasts[0]->Temperature->Maximum->Value],
                            "day" => $JSONdata->DailyForecasts[0]->Day->IconPhrase,
                            "night" => $JSONdata->DailyForecasts[0]->Night->IconPhrase
                            ];
            return $weatherData;
        }
        
    }
?>