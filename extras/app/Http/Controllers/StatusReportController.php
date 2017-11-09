<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Debugbar;
use Illuminate\Support\Facades\Input;


class StatusReportController extends Controller
{
    //

    public function index($sid)
    {
      return view('admins.students.status_report.index')
      ->with('student',\App\Student::find($sid));
    }
    public function show($sid,$id)
    {
      $student=\App\Student::find($sid);
      $pdf = \App::make('snappy.pdf.wrapper');
      $html=\View::make('admins.students.status_report.show',compact('student'))->render();
      \Debugbar::info($html);
      $pdf->loadHTML($html);
      return $pdf->inline('status_report.pdf');

    }
}
