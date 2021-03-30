@if (count($introductions) > 0)
    <ul class="introduction__wrapper list-unstyled">
        @foreach ($introductions as $introduction)
            <li class="media mb-3 container">
                <div class="media-body">
                    <div class="row"> 
                    <div class="col-md-6">
                    <div class='media-body__information'>
                        {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}
                            @if($introduction->user->profile_photo_path == null)
                                <div><a href="{{route('users.show',$introduction->user->id)}}"><img src="/img/profile_default.png" class="profile_img"></a></div>
                            @else
                                <div><a href="{{route('users.show',$introduction->user->id)}}"><img src={{$introduction->user->profile_photo_path}} class="profile_img"></a></div>
                            @endif
                        <h3>{!! link_to_route('users.show', $introduction->user->name, ['user' => $introduction->user->id],['class'=>'user__link']) !!}</h3>
                         <div><span class="text-muted">投稿日時 {{ $introduction->created_at }}</span></div>
                    </div>
                        <div class='row media-body__contents'>
                            {{-- 投稿内容 --}}
                            <p class="content">{!! nl2br(e($introduction->content)) !!}</p>
                        </div>
                        </div>
                     @if ($introduction->introduction_photo_path !== null)
                        <div class='introduction__img__wrapper col-md-6'>
                            {{-- 投稿写真 --}}
                            <img src="{{$introduction->introduction_photo_path}}" class="introduction__img">
                        </div>
                    @endif
                    </div>
                    <div class='handle__button'>
                        <div class="handle__button__wrapper">
                            <div class='handle__button__item'>
                                 <!--コメントボタン-->
                                @include("comments.commenting_button")
                            </div>
                            <div class='handle__button__item'>
                                <!--お気に入り登録ボタン-->
                                @include("favorites.favorites_button")
                            </div>
                            <div class='handle__button__item'>
                                @if (Auth::id() == $introduction->user_id)
                                    {{-- 投稿削除ボタンのフォーム --}}
                                    {!! Form::open(["route" => ["introductions.destroy",$introduction->id],"method" => "delete"]) !!}
                                        <!--{!! Form::submit('削除', ['class' => 'btn btn-outline-danger btn-block']) !!}-->
                                        <button class='delete__button'><i class="far fa-trash-alt fa-2x"></i></button>
                                    {!! Form::close() !!}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            @foreach($introduction->comments as $comment)
            <li class='media container'>
                <div class='media-body media-body__comments'>
                    <div class='media-body__comments_information'>
                            @if($comment->user->profile_photo_path == null)
                                <div><a href="{{route('users.show',$comment->user->id)}}"><img src="/img/profile_default.png" class="profile_img"></a></div>
                            @else
                                <div><a href="{{route('users.show',$introduction->user->id)}}"><img src={{$comment->user->profile_photo_path}} class="profile_img"></a></div>
                            @endif
                         <h3>{!! link_to_route('users.show', $comment->user->name, ['user' => $comment->user->id],['class'=>'coomment__link user__link']) !!}</h3>
                         <div><span class="text-muted">投稿日時 {{ $comment->created_at }}</span></div>
                    </div>
                    <div class='media-body__comments__contents'>
                        <p>{!! nl2br(e($comment->content)) !!}</p>
                    </div>
                    <div class='comment__handle__button'>
                        @if (Auth::id() == $comment->user->id)
                            {{-- コメント削除ボタンのフォーム --}}
                            {!! Form::open(["route" => ["comments.destroy",$comment->id],"method" => "delete"]) !!}
                              <button class='comment__delete__button'><i class="far fa-trash-alt fa-2x"></i></button>
                            {!! Form::close() !!}
                        @endif
                    </div>
                </div>
            </li>
            @endforeach
        @endforeach
    </ul>
    {{-- ページネーションのリンク --}}
    {{ $introductions->links() }}
@endif