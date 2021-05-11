@extends('layout.default')
@section('title', '重置密码')
@section('content')
    <div class="offset-md-2 col-md-8">
        <div class="card ">
            <div class="card-header">
                <h5>重置密码</h5>
            </div>
            <div class="card-body">
                @if(session('status'))
                    <div class="flash-message">
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            {{ session('status') }}
                        </div>
                    </div>
                @endif

                <form method="post" action="{{ route('password.email') }}">
                    @csrf
                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="form-control-label">邮箱地址：</label>
                        <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        @if($errors->has('email'))
                            <span class="form-text">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            发送密码重置邮件
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
