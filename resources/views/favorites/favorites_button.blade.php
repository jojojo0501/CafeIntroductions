@if (Auth::id() != $introduction->id)
    @if (Auth::user()->is_favorite($introduction->id))
        {{-- unfavoriteのフォーム --}}
        {!! Form::open(['route' => ['favorites.unfavorite', $introduction->id], 'method' => 'delete']) !!}
            {!! Form::submit('いいね削除', ['class' => "btn btn-outline-danger btn-block"]) !!}
        {!! Form::close() !!}
    @else
        {{-- favoriteのフォーム --}}
        {!! Form::open(['route' => ['favorites.favorite', $introduction->id]]) !!}
            {!! Form::submit('いいね', ['class' => "btn btn-outline-info btn-block"]) !!}
        {!! Form::close() !!}
    @endif
@endif
