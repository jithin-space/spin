
@extends('userform')


@section('page_heading', 'Edit Student')


@section('section')

<!-- general information section -->

        {!! form_start($form) !!}
        <input type="hidden" name="_method" value="put">
        {!! form_row($form->fname) !!}
        {!! form_row($form->lname) !!}
        {!! form_row($form->student_id, $formOptions = ['label' => "Student ID"]) !!}



        <input type="file" class="filestyle" name="profile" />

        <button type="submit" id="create" class="btn btn-labeled btn-primary"><span class="btn-label"><i class="fa fa-plus"></i></span>{{ 'save' }}</button>
        <a class="btn btn-labeled btn-default" href=" "><span class="btn-label"><i class="fa fa-chevron-left"></i></span>{{ 'cancel' }}</a>
        {!! form_end($form, $renderRest = false) !!}

<!-- end of general Information section -->


@endsection
