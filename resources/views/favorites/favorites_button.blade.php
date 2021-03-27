@if (Auth::id() != $introduction->id)
    @if (Auth::user()->is_favorite($introduction->id))
        {{-- unfavoriteのフォーム --}}
        {!! Form::open(['route' => ['favorites.unfavorite', $introduction->id], 'method' => 'delete']) !!}
            <button class='unfavorite__button'><i class="fas fa-heart fa-2x my-pink" style="color:#e54747;"></i></button>
            <!--{!! Form::submit('いいねから外す', ['class' => "btn btn-outline-danger btn-block"]) !!}-->
        {!! Form::close() !!}
    @else
        {{-- favoriteのフォーム --}}
        {!! Form::open(['route' => ['favorites.favorite', $introduction->id]]) !!}
            <button class='favorite__button'><i class="far fa-heart fa-2x my-gray"></i></button>
            <!--{!! Form::submit('いいね', ['class' => "btn btn-outline-info btn-block"]) !!}-->
        {!! Form::close() !!}
    @endif
@endif
