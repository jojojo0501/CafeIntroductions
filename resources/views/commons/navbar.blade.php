<header>
    <nav class="p-header navbar navbar-expand-md navbar-dark fixed-top">
        {{-- トップページへのリンク --}}
        <a class="p-header__link-top navbar-brand btn" href="/"><i class="fas fa-coffee"></i>Cafe Introductions</a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                @if (Auth::check())
                    {{-- ユーザ一覧ページへのリンク --}}
                    <li class="nav-item">{!! link_to_route('users.index', '登録ユーザー', [], ['class' => 'nav-link']) !!}</li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }}</a>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            {{-- ユーザ詳細ページへのリンク --}}
                            <li class="dropdown-item">{!! link_to_route('users.show', 'マイプロフィール', ['user' => Auth::id()],['class'=>'nav-dropdown']) !!}</li>
                            <!--<li class="dropdown-divider"></li>-->
                            {{-- ログアウトへのリンク --}}
                            <li class="dropdown-item">{!! link_to_route('logout.get', 'ログアウト',[],['class'=>'nav-dropdown']) !!}</li>
                        </ul>
                    </li>
                    <li class="nav-item">{!! link_to_route('introductions.create','カフェを紹介する',[],['class'=>'btn btn-lg'])!!}</li>
                @else
                    {{-- ユーザ登録ページへのリンク --}}
                    <li class="nav-item">{!! link_to_route('signup.get', 'ユーザー登録', [], ['class' => 'nav-link']) !!}</li>
                    {{-- ログインページへのリンク --}}
                    <li class="nav-item">{!! link_to_route('login', 'ログイン', [], ['class' => 'nav-link']) !!}</li>
                @endif
            </ul>
        </div>
    </nav>
</header>