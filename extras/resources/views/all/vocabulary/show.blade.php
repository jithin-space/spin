
  <label for="Long_Term_Objective">Long Term Objective:</label>
  <div class="row">
    <div class="col-md-7">
        <select class="selectpicker form-control"  data-size="10" id="ltos" name="lto" required >
             <option value="">Select A Long Term Objective</option>
              @foreach($datas['data'] as $lto)
                <option value="{{$lto->id}}">{{$lto->name}}</option>
              @endforeach
        </select>
    </div>
    <div class="col-md-1">
      <h4>OR&nbsp;</h4>
    </div>
    <div class="col-md-2" >
      <div class="models--actions">
          <a class="bbb btn btn-labeled btn-primary" data-toggle="modal" href="#myModal" data-id="{{ $datas['voc_id']}}" ><span class="btn-label"><i class="fa fa-plus"></i></span>{{'Add New LTO'}}</a>
      </div>
    </div>
  </div>
