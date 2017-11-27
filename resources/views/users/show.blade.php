@extends('master')

@section('title', 'Show user')

@section('content')
    <div class="form-group">
    <h3 style="font-family: 'Bahnschrift'">Dados Pessoais</h3>
        <label for="inputName">Name</label>
        <input
                type="text" class="form-control"
                name="name" id="inputName" readonly="readonly"
                placeholder="Fullname" value=""/>


        <label for="inputEmail">Email</label>
        <input
                type="email" class="form-control"
                name="email" id="inputEmail" readonly="readonly"
                placeholder="Email address" value=""/>


        <label for="inputNickname">Nickname</label>
        <input
                type="text" class="form-control"
                name="nickname" id="inputNickname" readonly="readonly"
                placeholder="Nickname" value=""/>

    </div>
    <hr/>


    <div>
        <a class="btn btn-xs btn-success" href="/">Back</a>
    </div>
@endsection


@section('pagescript')
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="/js/users/show-user.js"></script>

@endsection

@section('token')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection