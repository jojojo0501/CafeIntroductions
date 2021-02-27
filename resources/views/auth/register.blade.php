@extends('layouts.app')

@section('content')
    <div class='p-register'>
        <div class="p-register__title text-center">
            <h1>Cafe  Introductions</h1>
            <h2>ユーザー登録</h2>
        </div>
        <div class="row p-register__form">
            <div class="col-sm-6 offset-sm-3">
                {!! Form::open(['route' => 'signup.post']) !!}
                    <div class="form-group">
                        {!! Form::label('name', 'ユーザー名') !!}
                        {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('email', 'メールアドレス') !!}
                        {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('password', 'パスワード') !!}
                        {!! Form::password('password', ['class' => 'form-control']) !!}
                    </div>
    
                    <div class="form-group">
                        {!! Form::label('password_confirmation', 'パスワード(確認用)') !!}
                        {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                    </div>
                    <div class="p-register__button text-center">
                    {!! Form::submit('登録する', ['class' => 'btn btn-block']) !!}
                    </div>
                    {!! link_to_route('login', '既に登録済みの方はこちら',[],['class' => 'p-register__link-login']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection