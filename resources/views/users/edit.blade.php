@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-6 edit__form">
    <h1 class='text-center'>ユーザー情報編集</h1>
    @if (Auth::id() == 1)
    <p class="text-danger text-center">※ゲストユーザーは、ユーザー情報を編集できません。</p>
    @endif
            {!! Form::open(['route' =>['users.update','user'=>$user->id],'method'=>'put', 'enctype'=>'multipart/form-data']) !!}
            @csrf
            <div class="form-group">
                {!! Form::label('name', '名前:') !!}
                 @if (Auth::id() == 1)
                    <input class="form-control" type="text" id="name" name="name" value="{{ $user->name }}" disabled>
                 @else
                    <input class="form-control" type="text" id="name" name="name" value="{{ $user->name ?? old('name') }}">
                @endif
            </div>
            <div class="form-group">
                {!! Form::label('email', 'メールアドレス:') !!}
                @if (Auth::id() == 1)
                <input class="form-control" type="text" id="email" name="email" value="{{ $user->email }}" disabled>
                @else
                <input class="form-control" type="text" id="email" name="email" value="{{ $user->email ?? old('email') }}">
                @endif
            </div>
            <div class="form-group">
                {!! Form::label('profile_photo_path', 'プロフィール画像:') !!}
                @if (Auth::id() == 1)
                <input class="form-control" type="file" name="profile_photo_path" disabled>
                @else
                <input class="form-control" type="file" name="profile_photo_path">
                <!--{!! Form::file('profile_photo_path',['class' => 'form-control','name'=>'profile_photo_path']) !!}-->
                @endif
            </div>
            @if(Auth::id() == 1)
             {!! Form::submit('トップへ戻る', ['class' => 'btn btn-block edit__button']) !!}
            @else
            {!! Form::submit('更新', ['class' => 'btn btn-block edit__button']) !!}
            @endif
            {!! Form::close() !!}
        </div>
    </div>
@endsection