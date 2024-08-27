@extends('layouts.app')
@section('formulario','Cambiar Password')
@section('content')
<div class="row">
  <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-icon card-header-rose">
          <div class="card-text">
              <h4 class="card-title"><i class="fa fa-users"></i> Cambiar Password</h4>
          </div>
        </div>
        <div class="card-body">
            @if (Session::has('success'))
                <div class="alert alert-success">{!! Session::get('success') !!}</div>
            @endif
            @if (Session::has('failure'))
                <div class="alert alert-danger">{!! Session::get('failure') !!}</div>
            @endif
            <form action="" method="post" role="form" class="form-horizontal">
                {{csrf_field()}}

                <div class="row{{ $errors->has('old') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-4 col-form-label">Password Anterior</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="old">

                        @if ($errors->has('old'))
                            <span class="help-block">
                                <strong>{{ $errors->first('old') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="row{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-4 col-form-label">Nuevo Password</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="password">

                        @if ($errors->has('password'))
                            <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="row{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label for="password-confirm" class="col-md-4 col-form-label">Confirmar Password</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-danger">Cambiar Password</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>
@endsection

