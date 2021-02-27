@extends('layouts.app')

@section('content')
    <div class='p-login'>
        <div class="p-login__title text-center ">
            <h1>Cafe  Introductions</h1>
            <h2>ログイン</h2>
        </div>
        <div class="p-login__form row">
            <div class="col-sm-6 offset-sm-3">
                {!! Form::open(['route' => 'login.post']) !!}
                    <div class="form-group">
                        {!! Form::label('email', 'メールアドレス') !!}
                        {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('password', 'パスワード') !!}
                        {!! Form::password('password', ['class' => 'form-control']) !!}
                    </div>
                    {!! Form::submit('ログイン', ['class' => 'btn btn-block']) !!}
                {!! Form::close() !!}
                {{-- ユーザ登録ページへのリンク --}}
                {!! link_to_route('signup.get', 'ユーザー登録はこちら',[],['class' => 'p-login__link-register']) !!}
            </div>
        </div>
    </div>
@endsection