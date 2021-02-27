@extends('layouts.app')
@section('content')
<div class='comment__form'>
    {!! Form::open(['route' => ['comments.comment',$introduction->id]]) !!}
        <div class="form-group">
            {!! Form::label('content','コメント',['class'=>'comment__label']) !!}
            {!! Form::textarea('content',null,['class' => 'form-control']) !!}
        </div>
            {!! Form::submit('投稿する', ['class' => 'btn btn-block comment__button']) !!}
    {!! Form::close() !!}
</div>

@endsection('content')