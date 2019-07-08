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
/**
 *
 * All routes outside of Authentication
 *
 */
Route::get('/', function () {
	return view('welcome');
});
/*----------  Authentication via Sales Force   ----------*/

Route::get('/authenticate', function()
{
    return Forrest::authenticate();
});

Route::get('/callback', 'Login@checkUser');

Route::get('logout', function ()
{
	Forrest::revoke();
	Session::forget('forrest_token');
	return redirect('/');
});

/*----------  Middleware group for Authenticated Users   ----------*/
Route::middleware(['sf.login'])->group(function () {
	Route::get('/start', function () {
	    return view('start');
	});

	Route::get('api-debug', function () {
	return Forrest::identity();
	});

	Route::get('/sales', function () {
		// Chad Ward User Id for testing
		$id = '0051K000007qwOiQAI';
	    $data = Forrest::query('SELECT Id, Name, OwnerId, StageName, FiscalYear  FROM Opportunity WHERE FiscalYear=2019');
	    //$data = Forrest::query('SELECT Id, Name, Email FROM User');
	    return $data;
	});


}); //End Salesforce Middleware

Route::get('session', function () {
	return Session::all();
});


Route::Get('part/{pn}', function ($pn) {
	$part = App\Part::where('mtr_pn', '=', $pn)->first();
	$part->categories = $part->category_tree($part->category_id);



	echo $part->mtr_pn ." -> ". $part->categories->line->name ." -> ". $part->categories->cat->name ." -> ". $part->categories->maxCat->name ." -> ". $part->categories->minCat->name;

	
	// echo "<h1>".$part->mtr_pn/"</h1>";
});

Route::get('interchange/orphans', function() {
	$parts = App\Interchange::where('mtr_PN', '!=', '')->whereNull('part_id')->get();

	
	foreach ($parts as $key => $part) {
		$is_mtr = App\Part::where('mtr_pn', '=', $part->interchangesPN)->first();
		if(!$is_mtr)
		{
			if($part->mtr_PN == 'NI' || $part->mtr_PN == 'NA')
			{
				$parts->forget($key);
			}
			else{
				echo $part->interchangesPN .' -> ' .$part->mtr_PN . ' -> ' .$part->part_id .'<br>';
			}
			
		}
		else
		{
			$parts->forget($key);
		}
		
	}
	$total = count($parts);
	echo $total;
	
});

Route::get('interchange/{pn}', function($pn) {
	$is_mtr = App\Part::where('mtr_pn_stripped', '=', str_replace('-', '', $pn))->first();
	if($is_mtr)
	{
		echo 'Already a Motorad Part Number';
	}
	else
	{
		$interchange = App\Interchange::where('interchangesPN', '=', $pn)->first();

		$interchange->part;
		if($interchange->part)
		{
			echo $interchange->interchangesPN .' -> '. $interchange->part->mtr_pn;
		}
		else{
			echo '<p>No Interchange Available for <b><i>' .$pn. '</i></b></p>';
		}
	}

});

Route::post('/interchange/get-part', 'InterchangesController@getPart');

