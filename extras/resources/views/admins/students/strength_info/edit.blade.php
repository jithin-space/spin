@extends('studentform',['student'=>$student])
@section('page_heading', 'Edit Information')

@section('section')
  {!! form_start($form) !!}
    {!! form_row($form->name) !!}
    <?php if($a[1]=='1'){ ?>
    {!! form_row($form->strength_type) !!}
  <?php } elseif($a[1]=='2'){ ?>
    {!! form_row($form->weakness_type) !!}
  <?php }elseif($a[1]=='3'){ ?>
    {!! form_row($form->interest_type) !!}
    <?php } ?>
    {!! form_row($form->description) !!}
    {!! form_row($form->remarks) !!}
  <input type="hidden" name="_method" value="put" />
    <button type="submit" id="create" class="btn btn-labeled btn-success"><span class="btn-label"><i class="fa fa-plus"></i></span>{{ 'update' }}</button>
  {!! form_end($form) !!}

@endsection
