@extends('form')
@section('page_heading', 'Other Services Information')
@section('section')

{!! form_start($form) !!}
{!! form_row($form->media_type) !!}
{!! form_row($form->gallery) !!}

<button type="submit" id="create" class="btn btn-labeled btn-primary"><span class="btn-label"><i class="fa fa-plus"></i></span>{{ 'create' }}</button>
<a class="btn btn-labeled btn-default" href=" "><span class="btn-label"><i class="fa fa-chevron-left"></i></span>{{ 'cancel' }}</a>
{!! form_end($form) !!}
@endsection
