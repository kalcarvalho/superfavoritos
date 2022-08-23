<?php

$fullip = $_SERVER['REMOTE_ADDR'];

function hostipInfo($response) {
	$parts = explode("\n", $response);
	$data  = new stdClass();

	foreach ($parts as $part) {
		if (substr($part, 0, 5) == "City:") {
			$data->city = trim(str_replace("City:", "", $part));
		}
		if (substr($part, 0, 8) == "Country:") {
			$data->country = trim(str_replace("Country:", "", $part));
		}
		if (substr($part, 0, 10) == "Longitude:") {
			$data->long = trim(str_replace("Longitude:", "", $part));
		}
		if (substr($part, 0, 9) == "Latitude:") {
			$data->lat = trim(str_replace("Latitude:", "", $part));
		}
	}

	return $data;
}

function iplocationtools_com($response) {
	$xml                  = @simplexml_load_string($response);
	$data                 = new stdClass();
	$data->country        = $xml->CountryName;
	$data->countrycode    = $xml->CountryCode;
	$data->city           = $xml->City;
	$data->lat            = $xml->Latitude;
	$data->long           = $xml->Longitude;

	return $data;
}

function ipinfodb_com($response) {
	$data = new stdClass();
	$xml  = @simplexml_load_string($response);

	$data->country      = "" . $xml->CountryName;
	$data->countrycode  = "" . $xml->CountryCode;
	$data->city         = "" . $xml->City;
	$data->lat          = "" . $xml->Latitude;
	$data->long         = "" . $xml->Longitude;

	return $data;
}

function ipmango_com($response) {
	$xml = @simplexml_load_string($response);

	$data = new stdClass();
	$data->country = $xml->countryname;
	$data->countrycode = $xml->countrycode;
	$data->city = $xml->city;
	$data->lat = $xml->latitude;
	$data->long = $xml->longitude;

	return $data;
}

function pidgets_com($response) {
	$xml = @simplexml_load_string($response);

	$data = new stdClass();
	$data->country = $xml->country_name;
	$data->countrycode = $xml->country_code;
	$data->city = $xml->city;
	$data->lat  = $xml->latitude;
	$data->long = $xml->longitude;

	return $data;
}

function geoplugin_net($response) {
	$array = var_export(unserialize($response), 1);

	eval('$array = ' . $array . ';');

	$data  = new stdClass();

	$data->city   = $array['geoplugin_city'];
	$data->region = $array['geoplugin_region'];
	$data->country     = $array['geoplugin_countryName'];
	$data->countrycode = $array['geoplugin_countryCode'];
	$data->long        = $array['geoplugin_longitude'];
	$data->lat         = $array['geoplugin_latitude'];

	return $data;
}

$apis =
	array(
		array("url" => "http://www.geoplugin.net/php.gp?ip=%", "name" => "geoplugin_net"),
		array("url" => "http://ipinfodb.com/ip_query.php?ip=%", "name" => "ipinfodb_com"), //return Passo Fundo ... error
		array("url" => "http://api.hostip.info/get_html.php?position=true&ip=%", "name" => "hostip_info"),
		array("url" => "http://iplocationtools.com/ip_query.php?ip=%&output=xml", "name" => "iplocationtools_com"), //don't work turn payed
		array("url" => "http://www.ipmango.com/api.php?ip=%", "name" => "ipmango_com"), //don't work anymore, only get the site it 
		array("url" => "http://geoip.pidgets.com/?ip=%&format=xml", "name" => "pidgets_com"), //offline

	);

// select a random api
$api = rand(0, count($apis) - 1);

$api = 0;

// get the response
$apipath = str_replace("%", $fullip, $apis[$api]["url"]);

echo ("\n\n" . $api . ' = ' . $apis[$api]["name"] . ' - ' . $apipath . "\n");

//$response = wp_remote_fopen( $apipath );
$response = file_get_contents($apipath);

var_dump($response);

// run the function
$function = $apis[$api]["name"];
$data     = $function($response);

var_dump($data);
