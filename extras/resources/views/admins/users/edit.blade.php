@extends('userform')


@section('page_heading', 'Edit User')


@section('section')

{!! form_start($form) !!}
<input type="hidden" name="_method" value="put">
{!! form_row($form->name) !!}
{!! form_row($form->email) !!}
{!! form_row($form->Role) !!}
{!! form_row($form->change_passwd) !!}
{!! form_row($form->current_password) !!}
{!! form_row($form->new_password) !!}
  <button type="submit" id="create" class="btn btn-labeled btn-primary"><span class="btn-label"><i class="fa fa-plus"></i></span>{{ 'save' }}</button>
  <a class="btn btn-labeled btn-default" href=" "><span class="btn-label"><i class="fa fa-chevron-left"></i></span>{{ 'cancel' }}</a>
{!! form_end($form, $renderRest = true) !!}

<script>
$('#change_passwd').change(function() {
  if (this.checked) {
      $('#new_password').prop('disabled',false);
      $('#new_password_confirmation').prop('disabled',false);
      $('#current_password').prop('disabled',false);

    } else {
      $('#new_password').prop('disabled',true);
      $('#new_password_confirmation').prop('disabled',true);
      $('#current_password').prop('disabled',true);
    }
});

</script>


@endsection
