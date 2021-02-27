@if (count($introductions) > 0)
    <ul class="introduction__wrapper list-unstyled">
        @foreach ($introductions as $introduction)
            <li class="media mb-3 container">
                <div class="media-body">
                    <div class='media-body__information'>
                        {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}
                        {!! link_to_route('users.show', $introduction->user->name, ['user' => $introduction->user->id],['class'=>'user__link']) !!}
                    </div>
                    <div class='row media-body__contents'>
                        <div class='col-md-6'>
                            {{-- 投稿内容 --}}
                            <p class="content">{!! nl2br(e($introduction->content)) !!}</p>
                        </div>
                        <div class='offset-md-1 col-md-5'>
                            {{-- 投稿写真 --}}
                            <img src="{{$introduction->introduction_photo_path}}" width="100%" height="auto">
                        </div>
                    </div>
                    <div class='row handle__button'>
                        <span class="text-muted col-md-5">投稿日時 {{ $introduction->created_at }}</span>
                        <div class='offset-md-1 col-md-2'>
                             <!--コメントボタン-->
                            @include("comments.commenting_button")
                        </div>
                        <div class='col-md-2'>
                            <!--お気に入り登録ボタン-->
                            @include("favorites.favorites_button")
                        </div>
                        <div class='col-md-2'>
                            @if (Auth::id() == $introduction->user_id)
                                {{-- 投稿削除ボタンのフォーム --}}
                                {!! Form::open(["route" => ["introductions.destroy",$introduction->id],"method" => "delete"]) !!}
                                    {!! Form::submit('投稿削除', ['class' => 'btn btn-outline-danger btn-block']) !!}
                                {!! Form::close() !!}
                            @endif
                        </div>
                    </div>
                </div>
            </li>
            @foreach($introduction->comments as $comment)
            <li class='media container'>
                <div class='media-body media-body__comments'>
                    <div class='media-body__comments__contents'>
                         {!! link_to_route('users.show', $comment->user->name, ['user' => $comment->user->id],['class'=>'coomment__link']) !!}
                        <!--{{$comment->user->name}}-->
                        <p>{!! nl2br(e($comment->content)) !!}</p>
                    </div>
                    <div class='row comment__handle__button'>
                        <div class='col-md-5'>   
                            <span class="text-muted">投稿日時 {{ $comment->created_at }}</span>
                        </div>
                        <div class='offset-md-4 col-md-3'>
                            @if (Auth::id() == $comment->user->id)
                                {{-- コメント削除ボタンのフォーム --}}
                                {!! Form::open(["route" => ["comments.destroy",$comment->id],"method" => "delete"]) !!}
                                    {!! Form::submit('コメント削除', ['class' => 'btn btn-outline-danger btn-lg']) !!}
                                {!! Form::close() !!}
                            @endif
                        </div>
                    </div>
                </div>
            </li>
            @endforeach
        @endforeach
    </ul>
    {{-- ページネーションのリンク --}}
    {{ $introductions->links() }}
@endif