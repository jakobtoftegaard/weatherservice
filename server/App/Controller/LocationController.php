<?php
    namespace App\Controller;
    use \App\Controller\Controller;
    use \App\Model\AccuWeather;
    /**
     *Location controller. Find position based on ip, geo position etc. 
    */
    class LocationController extends Controller
    {
        
        /**
         *Contains the location model
        */
        public $locationModel;
        
        /**
         * Set the location model
        */
        public function beforeAction()
        {
            $this->locationModel = new AccuWeather();
        }
        
        /**
         *Look up position based on ip. Require the ip get parameter set.
        */
        public function get_location_by_ip()
        {
            $params = $this->request->params;
            if(!isset($params["ip"]))
            {
                throw new \Exception("Please specify ip address");
            }
            $location = $this->locationModel->getLocationByIp($params["ip"]);
            $this->set("outputData",$location);
        }
        /**
         *Look up position based on geo position. Require the latitude and longitude get parameter to be set.
        */
        public function get_location_by_geo_position()
        {
            $params = $this->request->params;
            
            if(!isset($params["latitude"]) || !isset($params["longitude"]))
            {
                throw new \Exception("Please specify latitude and longitude");
            }
            $location = $this->locationModel->getLocationFromGeoPosition($params["latitude"],$params["longitude"]);
            $this->set("outputData",$location);
        }
    }
    
?>