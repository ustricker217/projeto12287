@extends('master')

@section('extrastyles')
    <link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" />
@endsection

@section('title', 'Repositorio de peças')

@section('content')
    <table id="datatable" class="table table-striped">
        <center> <thead>
        <tr>
            <th>Face</th>
            <th>Tile</th>
            <th>Permissions</th>
            <th>Actions</th>
        </tr></center>
        </thead>
        <center><tbody>
        </tbody></center>
    </table>
@endsection

@section('pagescript')
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="/js/images/show-images.js"></script>
@endsection