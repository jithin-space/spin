{!! form_start($form) !!}
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
{!! form_row($form->name) !!}
{!! form_row($form->description) !!}
  <button type="submit" id="create" class="btn btn-labeled btn-success"><span class="btn-label"><i class="fa fa-plus"></i></span>{{ 'add' }}</button>
  <a class="btn btn-labeled btn-default" href="{{URL::previous()}}"><span class="btn-label"><i class="fa fa-chevron-left"></i></span>{{ 'cancel' }}</a>
{!! form_end($form, $renderRest = true) !!}
