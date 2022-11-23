<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>AIL - Impersonate</title>
</head>
<body>
    <h1>IMPERSONATE USERS</h1>

    <h2>GUARDS</h2>
    <ul>
        @foreach($guards as $guard)
            <li>
                <a href="#" @if($guard === $actualGuard) class="active" @endif>
                    {{ $guard }}
                </a>
            </li>
        @endforeach
    </ul>

    <h3>USERS</h3>
    <ul>
        @foreach($users as $user)
            <li>
                <a
                    @if($user->getKey() === $actualUser->getKey())
                        href="{{ route('impersonate.leave') }}"
                        class="active"
                    @else
                        href="{{ route('impersonate', ['id' => $user->getKey(), 'guardName' => $actualGuard]) }}"
                    @endif
                >
                    {{ $user->getImpersonateName() }}
                </a>
            </li>
        @endforeach
    </ul>
</body>
</html>
