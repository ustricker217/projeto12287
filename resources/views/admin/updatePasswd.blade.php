@extends('master')


@section('content')
    <div id="container">

        <div id="header">
            <center><h1> Change Administrators Password </h1></center><br/><br/>
        </div>
        <div id="form">
            <center><input type="password" placeholder="Current Password" id="currentPass"/></center><br/>
            <center><input type="password" placeholder="New Password" id="passOne"/></center><br/>
            <center><input type="password" placeholder="Confirm Password" id="passTwo"/></center>
        </div>
        <div id="footer" class="incorrect">
            <center><h4 id="footerText"> Filler text </h4></center>
        </div>
    </div>

@endsection

@section('pagescript')
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous">
    </script>
    <script src="/js/admin/changePassword.js"></script>
@endsection