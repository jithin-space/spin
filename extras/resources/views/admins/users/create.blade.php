@extends('userform')

@section('page_heading', 'Create User')

@section('section')

{!! form_start($form) !!}
{!! form_row($form->name) !!}
{!! form_row($form->email) !!}
{!! form_row($form->Role) !!}
{!! form_row($form->password) !!}

  <button type="submit" id="create" class="btn btn-labeled btn-primary"><span class="btn-label"><i class="fa fa-plus"></i></span>{{ 'create' }}</button>
  <a class="btn btn-labeled btn-default" href=" "><span class="btn-label"><i class="fa fa-chevron-left"></i></span>{{ 'cancel' }}</a>
{!! form_end($form, $renderRest = true) !!}


@endsection
