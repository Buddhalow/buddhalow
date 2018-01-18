@extends('layouts.app')

@section('content')
<div class="centeric">
    <div class="box">
        <div class="logo" style="text-align: center">
            <img src="/images/logo.svg" style="width: 128pt; height: 128pt">
            <h3>Buddhalow </h3>
            <p>Internal Services</p>
        </div>
        <form  onsubmit="onSubmit" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}

            <div id="success" style="display: none" class="alert alert-success">Login succeeed!</div>
            <div id="errors" style="display: none" class="alert alert-error">Invalid username or password</div>
            <label>User name</label>
            <input class="form-control" type="text" name="email">
            <label>Password</label>
            <input class="form-control" type="password"  name="password"><br>
            <button class="btn btn-primary">Log in</button>
            <br>
            <p>
                <i class="fa fa-warning"></i> REMEMBER! Always make sure you are on https://app.buddhalow.com.</p>
                
            </p>
            <p>This resource is only intended for employees of BUDDHALOW.</p>
        </form>
        <div style="display: none" class="spinner"></div>
    </div>
    <script>
        function onSubmit() {
            document.querySelector('form').style.display = 'none';
            document.querySelector('spinner').style.block = 'none';
        }
    </script>
</div>
@endsection
