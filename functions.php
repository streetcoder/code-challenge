<?php

function get_books($query_str){

    // your API key here
    $API_KEY = 'AIzaSyAN-BgOVefXASGJz7DLFscMYoowjKJMRHw';

    require_once 'vendor/autoload.php';

    // instantiate the Google API Client
    $client = new Google_Client();
    $client->setApplicationName("Yardi Google Books Code Challenge");
    $client->setDeveloperKey($API_KEY);

    // get an instance of the Google Books client
    $service = new Google_Service_Books($client);

    // set options for your request
    $optParams = [];

    // make the API call to retrieve some search results
    return $service->volumes->listVolumes($query_str, $optParams);
}

function in_array_r($needle, $haystack, $strict = false) {
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
            return true;
        }
    }
    return false;
}

function get_words($sentence, $count = 10) {
    preg_match("/(?:\w+(?:\W+|$)){0,$count}/", $sentence, $matches);
    return $matches[0];
}
