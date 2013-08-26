<?php
$requestParams = array(
    'CityName' => 'Berlin',
    'CountryName' => 'Germany'
);


$client=new SoapClient('http://www.webservicex.net/globalweather.asmx?WSDL');
$response = $client->GetWeather($requestParams);

$location = $response->GetWeatherResult; 

print_r($location);

?>
