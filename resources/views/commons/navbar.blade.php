<header class="mb-4">
    <nav class="navbar bg-yellow-500 text-gray-800">
        {{-- トップページへのリンク --}}
        <div class="flex-1">
            <h1><a class="btn btn-ghost normal-case text-xl" href="/">Tasklist</a></h1>
        </div>

        <div class="flex-1">
            <ul tabindex="0" class="menu lg:block lg:menu-horizontal">
                {{-- タスクリスト作成ページへのリンク --}}
                <li><a class="link link-hover" href="{{ route('tasks.create') }}">新規タスクの投稿</a></li>
            </ul>
        </div>
    </nav>
</header>