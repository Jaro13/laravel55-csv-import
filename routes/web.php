<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*

Route::get('/', function () {
    return view('welcome');
});

/*
1. etap ok
plik csv - usunąc 1 kolumne
to jest wersja bez kontrollera - jak utworzyć controller
route - csv_import - index, jakie funkcje?
jak dodać paginację



*/


use App\Csvdata;
Route::get ( '/', function () {

	if (($handle = fopen ( public_path () . '/MOCK_DATA.csv', 'r' )) !== FALSE) {
		while ( ($data = fgetcsv ( $handle, 1000, ',' )) !== FALSE ) {
			$csv_data = new Csvdata ();
			$csv_data->id = $data [0];
			$csv_data->firstname = $data [1];
			$csv_data->lastname = $data [2];
			$csv_data->email = $data [3];
			$csv_data->gender = $data [4];
			$csv_data->save ();
		}
		fclose ( $handle );
	}

	$finalData = $csv_data::all ();

	return view ( 'csv_import' )->withData ( $finalData );
} );
