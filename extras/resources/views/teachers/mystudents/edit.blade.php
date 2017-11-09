@extends('student_layout')
@section('heading', 'My Students')
@section('content')
    {!! form_start($form) !!}
    <div class="collection-container" data-prototype="{{ form_row($form->tags->prototype()) }}"> 
        {!! form_row($form->tags) !!}
    </div>
    {!! form_end($form) !!}
    <button type="button" class="add-to-collection">Add to collection</button>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script>
            $('.add-to-collection').on('click', function() {
                var container = $('.collection-container');
                var count = container.children().length;
                var proto = container.data('prototype').replace(/__NAME__/g, count);
                container.append(proto);
            });

    </script>


@endsection
