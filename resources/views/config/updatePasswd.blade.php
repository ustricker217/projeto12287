@extends('master')


@section('content')
    <div id="container">

        <div id="header">
            <center><h1> Change Password </h1></center>
        </div>
        <div id="form">
            <input type="password" placeholder="New Password" id="passOne"/>
            <input type="password" placeholder="Confirm Password" id="passTwo"/>
        </div>
        <div id="footer" class="incorrect">
            <h1 id="footerText"> Filler text </h1>
        </div>
    </div>

@endsection