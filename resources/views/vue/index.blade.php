@extends('master-vue')

@section('title', 'Memory Game')

@section('content')

    <router-view></router-view>
@endsection

@section('pagescript')
    <script src="/js/app.js"></script>

    <!-- <script src="/js/manifest.js"></script>
    <script src="/js/vendor.js"></script>
    <script src="/js/app.js"></script>
     -->
@stop
