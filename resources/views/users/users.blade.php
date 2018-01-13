@extends('master')

@section('extrastyles')
    <link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" />
@endsection

@section('title', 'Painel de Administrador')

@section('content')
    <div class="row">
        <br/>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading" style="height: 120px;">
                    <div class="row">
                        <div class="col-xs-3">
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$singleplayerGames}}</div>
                            <div>Jogos Singleplayer</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading" style="height: 120px;">
                    <div class="row">
                        <div class="col-xs-3">
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$multiplayerGames}}</div>
                            <div>Jogos Multiplayer</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading" style="height: 120px;">
                    <div class="row">
                        <div class="col-xs-3">
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$total}}</div>
                            <div>Jogos</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <table id="datatable" class="table table-striped">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Nickname</th>
            <th>Permission</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
@endsection


@section('pagescript')
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="/js/users/users.js"></script>

@endsection


@section('token')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
