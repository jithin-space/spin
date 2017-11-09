@extends('userform')


@section('page_heading', 'Create Student')


@section('section')

<!-- general information section -->
        {!! form_start($form) !!}
        {!! form_row($form->fname,$formOptions = ['label'=>"First Name"]) !!}
        {!! form_row($form->lname, $formOptions = ['label'=>"Last Name"]) !!}
        {!! form_row($form->student_id, $formOptions = ['label' => "Student ID"]) !!}
        {!! form_row($form->profile,$options = ['attr' => ['class' => 'filestyle'],'label'=>'Profile Image']) !!}

        <button type="submit" id="create" class="btn btn-labeled btn-primary"><span class="btn-label"><i class="fa fa-plus"></i></span>{{ 'Create' }}</button>
        <a class="btn btn-labeled btn-default" href=" "><span class="btn-label"><i class="fa fa-chevron-left"></i></span>{{ 'Reset' }}</a>
        {!! form_end($form, $renderRest = true) !!}



@endsection
