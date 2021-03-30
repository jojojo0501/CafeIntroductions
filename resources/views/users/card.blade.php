<div class="card">
    <div class="card-body">
        <h3 class="card-title text-center">{{ $user->name }}</h3>
           @if($user->profile_photo_path == null)
                <img src="/img/profile_default.png" class="card_img">
            @else
                <img src="{{$user->profile_photo_path}}" class="card_img">
            @endif
    </div>
    <div class="card-button">
        @if (Auth::id() === $user->id)
            {{-- 編集ページへのボダン --}}
            {!! link_to_route('users.edit','編集ページへ',['user'=>$user->id],['class'=>'btn btn-block edit__button']) !!}
        @else
            {{-- フォロー／アンフォローボタン --}}
            @include('user_follow.follow_button')
        @endif
    </div>
</div>

