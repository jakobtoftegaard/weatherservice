$(function(){
    var geoPosition = null;
    var showErrorText = function(text){
        $("#weather-container #output-panel .error").text(text);
    };
    var showText = function(text)
    {
        $("#weather-container #output-panel .content").text(text);
    };
    
    var storePosition = function(position){
        geoPosition = position;
    };
    var showPositionError = function(error)
    {
        showErrorText("Cannot get location, fallback to IP-based");
        $("#weather-container #locationLookupMethod").val("ip");
    };
    var lookUpWeather = function(){
        showErrorText("");
        showText("");
        var lookupMethod = $("#weather-container #locationLookupMethod").val();
        var ajaxUrl = "";
        if (lookupMethod == "geo" && geoPosition != null) {
            ajaxUrl = "http://api.weather.live/weather/get_todays_weather?latitude" + geoPosition.coords.latitude + "&longitude=" + geoPosition.coords.longitude;
        }
        else
        {
            ajaxUrl = "http://api.weather.live/weather/get_todays_weather";
        }
        $.ajax({url:ajaxUrl,
               dataType:'json',
               success:function(data){
                    var text = "The temperature i gonna range from " + data.temperature.low;
                    text += " to " + data.temperature.high + ".";
                    text += " it's " + data.day + " during day and " + data.night + " in night";
                    showText(text);
                }
                ,error:function(error){
                      showErrorText("Cannot receive weather data");
                }
                });
    };
    var locationMethodChange = function(){
        var method = $(this).val();
        if (method == "geo") {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(storePosition, showPositionError);
            }
            else
            {
                showErrorText("Your browser does not support geo localization");
            }
        }
        lookUpWeather();
    };
    $("#weather-container #locationLookupMethod").change(locationMethodChange);
    lookUpWeather();
});