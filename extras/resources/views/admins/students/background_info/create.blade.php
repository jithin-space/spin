@extends('studentform',['student'=>$student])
@section('page_heading', 'Create Background Info')
@section('section')
      <div class="container">
        <div class="modal fade" id="myModal3" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Create Background Info Type</h4>
              </div>
              <div class="modal-body" id="out3">
                <p>Some text in the modal.</p>
                  <input type="text" name="bookId" id="bookId" value=""/>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>

          </div>
        </div>

      </div>
  <div class="col-md-3 pull-right">
  <a href="#myModal3" data-toggle="modal"  class="ddd btn btn-success">Add New Info Type</a>
</div>
    {!! form_start($form) !!}
    <div class="collection-container" data-prototype="{{ form_row($form->tags->prototype()) }}">
        {!! form_row($form->tags) !!}
    </div>

    <button type="button" class="btn btn-labeled btn-primary add-to-collection"><span class="btn-label"><i class="fa fa-plus"></i></span>Add Another Info</button>
    <button type="submit" id="create" class="btn btn-labeled btn-success"><span class="btn-label"><i class="fa fa-plus"></i></span>{{ 'save' }}</button>
    <a class="btn btn-labeled btn-default" href="{{URL::previous()}} "><span class="btn-label"><i class="fa fa-chevron-left"></i></span>{{ 'cancel' }}</a>

    {!! form_end($form) !!}


    <script>
            $('.add-to-collection').on('click', function() {
                var container = $('.collection-container');
                var count = container.children().length;
                var proto = container.data('prototype').replace(/__NAME__/g, count);
                container.append(proto);
            });

    </script>
    <script>
    $(document).on("click", ".ddd", function () {
     var xhttp;
    //  hard coded value..careful in changing that value...........
     var id = 5;
     var ajaxurl = '{{route("terms.create")}}';
      xhttp=new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("out3").innerHTML = xhttp.responseText;
          $("#dummy").attr("value",id);

        }
      };
      xhttp.open("GET",ajaxurl, true);
      xhttp.send();

    });

    </script>

@endsection
