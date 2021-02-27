@if (count($users) > 0)
    <ul class="list-unstyled user__icons row">
        @foreach ($users as $user)
            <li class="media user__icon">
                <div class="media-body user__icon text-center">
                        {{-- ユーザ詳細ページへのリンク --}}
                        {!! link_to_route('users.show', $user->name, ['user' => $user->id],['class'=>'user__icon__name']) !!}
                        <img src="{{$user->profile_photo_path}}" width='100%',height='auto' class='rounded'>
                </div>
            </li>
        @endforeach
    </ul>
    {{-- ページネーションのリンク --}}
    {{ $users->links() }}
@endif