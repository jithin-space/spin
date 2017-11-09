@extends('studentform',['student'=>$student])

@section('page_heading', 'Edit Guardian Info')

@section('section')
  {!! form_start($form) !!}
    {!! form_row($form->first_name) !!}
    {!! form_row($form->last_name) !!}
    {!! form_row($form->occupation) !!}
    {!! form_row($form->relationship) !!}
    {!! form_row($form->status) !!}
    {!! form_row($form->Address) !!}
    {!! form_row($form->email) !!}
  <input type="hidden" name="_method" value="put" />
    <button type="submit" id="create" class="btn btn-labeled btn-success"><span class="btn-label"><i class="fa fa-plus"></i></span>{{ 'update' }}</button>
  {!! form_end($form) !!}

@endsection
