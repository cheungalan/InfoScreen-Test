<?php

$url = "http://rss.weather.gov.hk/rss/CurrentWeather.xml";

$xml = file_get_contents($url);
print_r($xml);

?>