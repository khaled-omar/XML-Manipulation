<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Process;
use App\Member;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    
    public function save(Request $request)
    {
        //return $request->all();
            //
     $this->validate($request, [
        'name' => 'required|min:3|max:255',
        'fitness'=>'required',
        'speed'=>'required',
        'tallness'=>'required',
        'weight'=>'required',
        'recommendation'=>'required'
        ]);
     Member::create($request->all());
     return redirect()->back()->with('status', "Successfuly added")->withInput();

 }
 public function index()
 {
    $process = new Process();  
    $Rules = $process->Ruleslist();
    //dd($Rules);

    //print($RulesTest[1]['game']);
    $members = Member::all();
       //return $members;
    return view('home',compact(['members','Rules']));
}
}
