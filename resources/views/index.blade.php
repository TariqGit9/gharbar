@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Login as</div>

                <div class="card-body">
                    <div class="row  text-center">
                      <div class="col-2">
                      </div>
                      <div class="col-2" style="white-space: nowrap ;">
                        <a type="button " href="{{ route('super-admin-login') }}" class="btn btn-primary">Super Admin</a>
                      </div>
                      <div class="col-2">
                        <a type="button" href="{{ route('admin-login') }}" class="btn btn-secondary">Admin</a>
                      </div>
                      <div class="col-2">
                        <a type="button" href="{{ route('user-login') }}" class="btn btn-success">User</a>
                      </div>
                      <div class="col-2">
                        <a type="button" href="{{ route('blogger-login') }}" class="btn btn-danger">Blogger</a>
                      </div>
                      <div class="col-2">
                      </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
