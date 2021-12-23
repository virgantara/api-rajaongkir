<?php
require_once 'vendor/autoload.php';

use GuzzleHttp\Client;

	
define("C_RAJAONGKIR_KEY","#");
define("C_BASE_URI","https://api.rajaongkir.com");

function getListProvince($id=null){
	$headers = ['key' => C_RAJAONGKIR_KEY];
	$client = new Client([
		'timeout'  => 5.0,
		'headers' => $headers
	]); 

	$full_url = C_BASE_URI.'/starter/province';

	$params = [
		'query' => [
			'id' => $id
		]
	];

	$response = $client->request('GET',$full_url, $params);
	$response = json_decode($response->getBody());	

	return $response;
}

function getListCityByProvince($province_id=null){
	$headers = ['key' => C_RAJAONGKIR_KEY];
	$client = new Client([
		'timeout'  => 10.0,
		'headers' => $headers
	]); 

	$full_url = C_BASE_URI.'/starter/city';

	$params = [
		'query' => [
			'province' => $province_id
		]
	];

	$response = $client->request('GET',$full_url, $params);
	$response = json_decode($response->getBody());	

	return $response;
}

function getCostByCity($origin, $destination, $berat = 1000, $kurir = 'jne'){
	$headers = ['key' => C_RAJAONGKIR_KEY];
	$client = new Client([
		'timeout'  => 10.0,
		'headers' => $headers
	]); 

	$full_url = C_BASE_URI.'/starter/cost';

	$params = [
		'form_params' => [
			'origin' => $origin, // sby
			'destination' => $destination, // png,
			'weight' => $berat,
			'courier' => $kurir
		]
	];

	$response = $client->request('POST',$full_url, $params);
	$response = json_decode($response->getBody());	

	return $response;
}


// $list_province = getListProvince(11);

$cost = getCostByCity(444, 363, 1000);
// $list_city = getListCityByProvince(11);
echo '<pre>';
// $province_id = $list_province->rajaongkir['results'][0][province_id;
print_r($cost);
echo '</pre>';

exit;
