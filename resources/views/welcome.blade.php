@extends('layouts.app')

@section('content')
    @if (Auth::check())
        <div class='p-top__board'>
        {{-- 投稿一覧 --}}
        @include('introductions.introductions')
        </div>
    @else
        <div class="p-top">
            <div class="p-top__container text-center">
                <div class="p-top__title">
                    <h2>あなたに<br>ピッタリなカフェと出会える</h2>
                    <h1>Cafe  Introductions</h1>
                </div>
                <div class="p-top__contents text-center">
                        <h3>あなたのおすすめの<br>カフェをシェアしよう</h3>
                    <div class="p-top__example">
                        <p>お世話になっている行きつけのカフェ</p>
                        <p>友人と初めて行ったあこがれのカフェ</p>
                        <p>週末に必ず行くパンケーキが美味しいあのカフェ</p>
                        <p>なんでもOK!気軽に投稿してください ！</p>
                    </div>
                </div>
            </div>
            {{-- ログインページへのリンク --}}
            <div class="p-top__button text-center">
                 {{-- ログインページへのリンク --}}
                <p class="p-top__link-login">{!! link_to_route('login', 'ログイン', [], ['class' => 'btn btn-lg btn-light' ,'style' => 'opacity: 0.8;','background-color:#EEEEEE;']) !!}</p>
                {{-- ユーザ登録ページへのリンク --}}
                <p class="p-top__link-register">{!! link_to_route('signup.get', 'アカウントを作成', [], ['class' => 'btn btn-lg btn-light' ,'style' => 'opacity: 0.8;','background-color:#EEEEEE;']) !!}</p>
            </div>
        </div>
    @endif
@endsection