@extends('layouts.app')

@section('content')
    <div class='p-makeIntroduction'>
        <div class='p-makeIntroduction__form'>
            {!! Form::open(['route' => 'introductions.store','files'=>true]) !!}
                <div class="form-group">
                    {!! Form::label('introduction_photo_path','投稿する画像を選択してください') !!}
                    {!! Form::file('introduction_photo_path', ['class' => 'form-control','name'=>'introduction_photo_path']) !!}
                   </div>
                <div class="form-group">
                    {!! Form::label('content','内容') !!}
                    {!! Form::textarea('content', old('content'), ['class' => 'form-control','placeholder'=>'200文字以下で入力してください']) !!}
                </div>
                    {!! Form::submit('投稿する', ['class' => 'btn btn-block p-makeIntroduction__button']) !!}
            {!! Form::close() !!}
        </div>
    </div>

@endsection('content')