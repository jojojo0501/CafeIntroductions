@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-xl-4">
            {{-- ユーザ情報 --}}
            @include('users.card')
        </aside>
        <div class="col-xl-8">
            {{-- タブ --}}
            @include('users.navtabs')
            {{-- ユーザ一覧 --}}
            @include('users.users')
        </div>
    </div>
@endsection