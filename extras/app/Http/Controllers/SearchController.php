<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use App\Http\Requests;
use Debugar;

class SearchController extends Controller
{
    //

    public function index()
    {
      return view('admins.students.search.index');
    }
    public function find(Request $request)
      {
       \Debugbar::info(\App\Student::where('fname','like','%'.$request->get('q').'%')->get());
        //  \Debugbar::info(\DB::connection('mongodb')->find('students.find({ fname: {$regex: /ja/i}})')->get());
          return \App\Student::where('fname','like','%'.$request->get('q').'%')->orWhere('lname','like','%'.$request->get('q').'%')->get();
      }
    public function show($id)
    {
      echo "hello";
    }
}
