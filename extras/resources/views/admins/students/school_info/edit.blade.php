@extends('studentform',['student'=>$student])

@section('page_heading', 'Edit Information')

@section('section')
  {!! form_start($form) !!}
    {!! form_row($form->school_name) !!}
    {!! form_row($form->school_type) !!}
    {!! form_row($form->status) !!}
    {!! form_row($form->Year_Of_Joining) !!}
    {!! form_row($form->Year_Of_Completion) !!}
    {!! form_row($form->Address) !!}
    {!! form_row($form->email) !!}
  <input type="hidden" name="_method" value="put" />
    <button type="submit" id="create" class="btn btn-labeled btn-success"><span class="btn-label"><i class="fa fa-plus"></i></span>{{ 'update' }}</button>
  {!! form_end($form) !!}

@endsection
