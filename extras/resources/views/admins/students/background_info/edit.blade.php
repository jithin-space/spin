@extends('studentform',['student'=>$student])

@section('page_heading', 'Edit Background Info')

@section('section')
  {!! form_start($form) !!}
    {!! form_row($form->Info_Type) !!}
    {!! form_row($form->Description) !!}
  <input type="hidden" name="_method" value="put" />
    <button type="submit" id="create" class="btn btn-labeled btn-primary"><span class="btn-label"><i class="fa fa-plus"></i></span>{{ 'update' }}</button>
  {!! form_end($form) !!}

@endsection
