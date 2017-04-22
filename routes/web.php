<?php
use App\Process;
use App\Member;
//use Illuminate\Http\Request;


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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

// ------------ get Recommended games Route  ---------------//
Route::post('checkRecommendation', function() {
    if (Request::ajax()) {
   
        $process = new Process();  
        $recs = $process->filterList(Request::except(["_token","_method"]));
        return $recs;
    }
    
});


// ------------ Rules Routes  ---------------//
Route::Delete('Rules/{name}', function ($name) {
    //
    $process = new Process();  
    $Rule = $process->DeleteRule($name);
    return redirect()->back()->with('msg','successfuly Removed');

})->where('name', '^[a-zA-Z0-9]*$');

Route::get('Rules/Create', function() {
    return view('addRule');
});
Route::post('Rules', function(Illuminate\Http\Request $request) {
    //
/*    $this->validate($request, [
        'name' => 'required|min:3|max:255',
        'game' => 'required|min:3|max:255',
        'fitness'=>'required',
        'speed'=>'required',
        'tallness'=>'required',
        'weight'=>'required',
        ]);
    */
    $data = [
    'fitness'=>$request->fitness,
    'speed'=>$request->speed,
    'tallness'=>$request->tallness,
    'weight'=>$request->weight
    ];
    $process = new Process();  
    $Rule = $process->AddRule($data,[
        'name'=>$request->name,
        'game'=>$request->game,
        ]);
    return redirect('/home')->with('msg','Rule successfuly added');

});
Route::get('Rules/edit/{name}', function($name) {
    //
    $process = new Process();  
    $Rule = $process->getRuleByName($name);
    //dd($Rule['fitness']);
    return view('editRule',compact('Rule'));
})->where('name', '^[a-zA-Z0-9]*$');

Route::put('Rules/{name}', function(Illuminate\Http\Request $request,$name) {
    //
    $process = new Process();  
    $Rule = $process->updateRule($request->except(["_token","_method"]),$name);
    return redirect('/home');
})->where('name', '^[a-zA-Z0-9]*$');



// ------------ Members Routes  ---------------//
Route::post('Members', 'HomeController@save');

Route::delete('Members/{id}', function($id) {
    //
    Member::findOrFail($id)->delete();
    return redirect('/home');
});

Route::get('Members/edit/{id}', function($id) {
    //
   // Member::findOrFail($id)->delete();
    $member = Member::findOrFail($id);
    return view('editMember',compact('member'));
});

Route::Put('Members/{id}', function(Illuminate\Http\Request $request,$id) {

    $member = Member::findOrFail($id);
    $member->name = $request->name;
    $member->fitness = $request->fitness;
    $member->speed = $request->speed;
    $member->tallness = $request->tallness;
    $member->weight = $request->weight;
    $member->recommendation = $request->recommendation;
    $member->save();
    return redirect('/home');
});