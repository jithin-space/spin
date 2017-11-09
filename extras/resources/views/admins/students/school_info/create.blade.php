@extends('studentform',['student',$student])
@section('page_heading', 'My Students')
@section('section')

{!! form_start($form) !!}
<div class="collection-container" data-prototype="{{ form_row($form->school->prototype()) }}">
    {!! form_row($form->school) !!}
</div>

<button type="button" class="btn btn-labeled btn-primary add-to-collection"><span class="btn-label"><i class="fa fa-plus"></i></span>Add Another Info</button>
<button type="submit" id="create" class="btn btn-labeled btn-success"><span class="btn-label"><i class="fa fa-plus"></i></span>{{ 'create' }}</button>
<a class="btn btn-labeled btn-default" href="{{URL::previous()}}"><span class="btn-label"><i class="fa fa-chevron-left"></i></span>{{ 'cancel' }}</a>

{!! form_end($form) !!}


<script>
        $('.add-to-collection').on('click', function() {
            var container = $('.collection-container');
            var count = container.children().length;
            var proto = container.data('prototype').replace(/__NAME__/g, count);
            container.append(proto);
            $.when(
                $.getScript('{{ URL::asset("js/jquery.min.js")}}'),
              $.getScript( '{{ URL::asset("js/bootstrap.min.js")}}' ),
              $.getScript( '{{ URL::asset("js/bootstrap-select.js")}}'),
                $.getScript( '{{ URL::asset("js/bootstrap-formhelpers.js")}}' ),

                $.Deferred(function( deferred ){
                    $( deferred.resolve );
                })
            ).done(function(){

            });
        });

</script>
@endsection
