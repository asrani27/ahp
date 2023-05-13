@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<div class="row">
    <div class="col-md-3">

      <!-- Profile Image -->
      <div class="box box-primary">
        <div class="box-body box-profile">
          <img class="profile-user-img img-responsive img-circle" src="/logo/icon-user.png" alt="User profile picture">

          <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>

          <p class="text-muted text-center">{{Auth::user()->email}}</p>
          
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

      
    </div>
    <!-- /.col -->
    <div class="col-md-9">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#settings" data-toggle="tab" aria-expanded="true">Settings</a></li>
        </ul>
        <div class="tab-content">
            

          <div class="tab-pane active" id="settings">
            <form class="form-horizontal">
              <div class="form-group">
                <label for="inputName" class="col-sm-3 control-label">Username</label>

                <div class="col-sm-9">
                  <input type="text" class="form-control" id="inputName" value="{{$data->name}}" readonly>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail" class="col-sm-3 control-label">Email</label>
                <div class="col-sm-9">
                  <input type="email" class="form-control" id="inputEmail" value="{{$data->email}}" readonly>
                </div>
              </div>
              <div class="form-group">
                <label for="inputName" class="col-sm-3 control-label">Password Baru</label>

                <div class="col-sm-9">
                    <input type="text" class="form-control" name="password">
                </div>
              </div>
              <div class="form-group">
                <label for="inputExperience" class="col-sm-3 control-label">Masukkan Lagi Password Baru</label>

                <div class="col-sm-9">
                    <input type="text" class="form-control" name="confirm_password">
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                  <button type="submit" class="btn btn-primary">Update Password</button>
                </div>
              </div>
            </form>
          </div>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
  </div>
@endsection
@push('js')
    
@endpush
