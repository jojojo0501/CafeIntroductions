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
            {{-- 投稿一覧 --}}
            @include('introductions.introductions')
        </div>
    </div>
@endsection