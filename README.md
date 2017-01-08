# Weather service
This project is a simple service that offers today's weather information. It is split into a very html5 based frontend and backend. I have focussed mostly on the backend. The frontend can be seen on https://weather.jtconsult.eu and the backend service is at https://weatherapi.jtconsult.eu.

#Tools
The weather service is based on AccuWeather's API (developer.accuweather.com) and uses a minor part of their API. The backend is developed in plain PHP 7.0. 

The frontend is html5 based with geolocalization and jquery 3.

#Architecture
The backend is built up as a REST web service, with only GET requests. It is built as a small Model View Controller (MVC) framework. I choose to build my own solution such that the separation of what I have done is clear. In a real work example, I would have preferred an already existent solution. I choose the MVC pattern because the enables easy extension or switching the weather source to another API and changing to another output format would be straight forward without conflicting with the existent code. 

#API
The API consist of two services a locations service and weather service. The frontend is only communicating with the weather service. The weather service has one function, "get_todays_weather" this function return JSON object with temperature and description of the weather (sunny, cloudy, rain, etc.). This function can be called either with no argument (finding location based on IP), geolocation, AccuWeather areakey. The parameter are the following
areakey: Accuweather area key
latitude: geolocation latitude (require longitude set)
longitude: geolocation longitude (require latitude set)
If multiple arguments are will they be prioritized in the following order: areakey, geolocation, IP.

The location service has the following functions 
get_location_by_ip 

params:

ip (required): ip address


get_location_by_geo_position

params

latitude (required): geo location latitude

longitude (required): geo location longitude

both functions return a JSON object with area information including the AccuWeather areakey.

#Testing
The project uses PHPUnit for unit and integration test.


#Missing features/testing
I have focused on testing the AccuWeatherModel and the WeatherController, there do not exist any test for the remaining framework. There is no automated test of web service interface. Although, if time allows I would have created a postman setup.
Error handling is quite simple and logging is simple (only normal apache2 logging). If time allows, I would have extended the solution with logging and also setting up a system for monitoring uptime and resource use of the service. 
There is no check for request type e.g. a post request would respond in the same manner as a get request. 
This solution is open for DDoS attacks. A feature that only allows a certain amount of request per connection would be smart.

#Public profile
https://www.linkedin.com/in/jakob-toftegaard

#Other projects
The code project I have been working at during my Ph.D. is not available. During my bachelor, I made a software library for calculating stopping power of ions transverse matter. It is named libdEdx and can be found on GitHub https://github.com/APTG/libdedx. At http://dedx.au.dk there is a simple user interface for this library. All the code is mainly developed by me.
Another project I started during my master were pytrip, which is python binding and a user interface for a heavy ion cancer treatment planning system. I have not a part of this the past few year. Although, most of the code base is programmed and designed by me. 

