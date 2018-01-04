@extends('master-vue')

@section('title', 'Memory Game')

@section('content')
    <router-link to="/singlememory">SinglePlayer Memory Game</router-link> -
    <router-link to="/multimemory">Multiplayer Memory Game</router-link>
    <router-link to="/login">Login</router-link>

    <router-view></router-view>
@endsection

@section('pagescript')
<script src="js/app.js"></script>

<!-- <script src="/js/manifest.js"></script>
<script src="/js/vendor.js"></script>
<script src="/js/app.js"></script>
 -->
 @stop  
