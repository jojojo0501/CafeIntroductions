@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-6 edit__form">
    <h1 class='text-center'>ユーザー情報編集</h1>
            {!! Form::open(['route' =>['users.update','user'=>$user->id],'method'=>'put', 'enctype'=>'multipart/form-data']) !!}
            @csrf
                <div class="form-group">
                    {!! Form::label('name', '名前:') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('email', 'メールアドレス:') !!}
                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('profile_photo_path', 'プロフィール画像:') !!}
                    {!! Form::file('profile_photo_path',['class' => 'form-control','name'=>'profile_photo_path']) !!}
                </div>
                {!! Form::submit('更新', ['class' => 'btn btn-block edit__button']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection