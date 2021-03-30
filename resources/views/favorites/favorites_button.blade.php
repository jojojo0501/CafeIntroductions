@if (Auth::id() != $introduction->id)
    @if (Auth::user()->is_favorite($introduction->id))
        {{-- unfavoriteのフォーム --}}
        {!! Form::open(['route' => ['favorites.unfavorite', $introduction->id], 'method' => 'delete']) !!}
            <button class='unfavorite__button'><i class="fas fa-heart fa-2x my-pink" style="color:#e54747;"></i></button>
            {{$introduction->favorite_users->count()}}
        {!! Form::close() !!}
    @else
        {{-- favoriteのフォーム --}}
        {!! Form::open(['route' => ['favorites.favorite', $introduction->id]]) !!}
            <button class='favorite__button'><i class="far fa-heart fa-2x my-gray"></i></button>
            {{$introduction->favorite_users->count()}}
        {!! Form::close() !!}
    @endif
@endif
