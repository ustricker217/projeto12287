@extends('master')


@section('content')
    <div id="container">

        <div id="header">
            <center><h1> Change Config Mail </h1></center><br/><br/>
        </div>
        <div id="form">
            <center><input type="email" placeholder="Current Email" id="currentMail"/></center><br/>
            <center><input type="email" placeholder="New Email" id="newMail"/></center>
        </div>
        <div id="footer">
            <br/>
        </div>
    </div>

@endsection

@section('pagescript')
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous">
    </script>
    <script src="/js/admin/changeMailConfig.js"></script>
@endsection