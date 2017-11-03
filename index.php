<?php

header('Access-Control-Allow-Origin: *');

error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'vendor/autoload.php';
 
$debug = false;
$database = null;

if($debug){
	$database = new Medoo\Medoo([
		'database_type' => 'mysql',
		'database_name' => 'gloparktools',
		'server' => 'localhost',
		'username' => 'root',
		'password' => '123'
	]);	
} else {
	$database = new Medoo\Medoo([
		'database_type' => 'mysql',
		'database_name' => 'db602ccdea9530499caf60a8200067fc96',
		'server' => '602ccdea-9530-499c-af60-a8200067fc96.mysql.sequelizer.com',
		'username' => 'zlehuclwftemqcrv',
		'password' => 'xzLvfuuxY6mNKNnBYUeB8ts4UkTYvdWnzJxuF26HfVAZ3UqEFQLZamYdhRH3JDcU'
	]);
}

Flight::route('GET|POST /@bin_number:[0-9]+', function($bin_number){	
	global $database;
	
	$data = $database->get('binlist', [
		'bin_number', 'eft_code', 'slug', 'bank_short_name', 'bank_name', 'scheme_network', 'brand'
	], [
		'bin_number' => substr($bin_number, 0, 6)
	]);
	
	if(empty($data)){
		Flight::notFound();
	}else{	 
		Flight::json( $data );
	}
});

Flight::start();