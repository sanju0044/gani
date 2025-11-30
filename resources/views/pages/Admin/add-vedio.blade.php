@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" 
              href=
"https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.min.css" />
  
@section('content')
<style>
  .wrapper .content-wrapper{
    margin-left:0px !important;
  }
  .col-md-6.login-form-wrapper{
    padding: 11px 0px 18px 0px !important;
  }
  nav.main-header.navbar.navbar-expand.navbar-white.navbar-light{
    margin-left: 0px !important;
  }
  footer.main-footer{
    margin-left: 0px !important;
  }
  .card{
    box-shadow:none;
  }
  h2.header-text {
      color: #1cacd1;
  }
  .btn-register{
    margin-top:40px;
  }
  .card.login-card-wrapper{
    margin:0px;
    width:100%;
  }
  .formm{
    margin-left: 232px;
  }
</style>
<!-- /.login-logo -->
<div class="container">
  <div class="card login-card-wrapper">
      <div class="card-body login-card-body">
        <form action="{{ url('admin/save_vedio') }}" method="post">
          <div class="row">
            <div class="col-md-12 offset-md- 2 login-form-wrapper">
              <div class="col-md-12 formm">
                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="col-sm-12">
                        <label for="url" class="col-form-label">Embedded Url:</label>
                        <input type="text" class="form-control" name="url" placeholder="Enter Embedded Url"  name="url" />
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                          <div class="col-sm-12">
                              <label for="menot" class="col-form-label">Select Mentor:</label>
                              <select  name="mentor_type[]" id="id" class="form-control myselect select2" multiple="true">
                                  <option value="">Select Mentor</option>
                                  <option value="1" {{ 1 == Auth::user()->mentor_type  ? 'selected' : ''}}>Local</option>
                                  <option value="2" {{ 2 == Auth::user()->mentor_type  ? 'selected' : ''}}>Academician </option>
                                  <option value="3" {{ 3 == Auth::user()->mentor_type  ? 'selected' : ''}}>National / International </option>
                                  <option value="4" {{ 4 == Auth::user()->mentor_type  ? "selected" : ''}}>Exclusive</option>
                              </select>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-12 ">
                        <div class="col-md-6">
                        <div class="form-group">
                          <label for="staticEmail" class="col-form-label">Select Student:</label>
                              <select name="standard[]" id="id" class="form-control myselect-service-package select2" multiple="true" >
                                  <option value="">Select Student</option>
                                  @foreach($standards as $standard)
                                    <option value="{{$standard->name}}" {{$standard->name == Auth::user()->standard  ? 'selected' : ''}}>{{$standard->name}}</option>
                                  @endforeach
                              </select>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <button type="submit" class="btn btn-primary btn-block btn-signin">Submit</button>
                  </div>
            </div>
          </div>
        </form>
      </div>
      <!-- /.login-card-body -->
  </div>
</div>
@endsection

@push("scripts")
<script type="text/javascript" src="{{ asset('assets/DataTables/datatables.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src=
"https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js">
        </script>
        
<script>
$(document).ready(function() {
    if ($('.myselect').length > 0) {
    $('.myselect').chosen();  
    $('.myselect-service-package').chosen();  
  };
});
</script>
@endpush
