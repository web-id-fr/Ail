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
            <a href="{{ route(config('ail.routes.name') . '.index', ['guard' => $guard]) }}" @if($guard === $actualGuard) class="active" @endif>
                {{ $guard }}
            </a>
        </li>
    @endforeach
</ul>

<h3>USERS</h3>
<ul>
    @foreach($users as $user)
        @php
            $isActualImpersonatedUser = $isImpersonating && $user->getKey() === $actualUser?->getKey();
        @endphp

        @if(
            ($impersonateId && $user->getKey() !== $impersonateId)
            || (!$impersonateId && $user->getKey() !== $actualUser->getKey())
        )
            <li>
                <a
                    @if(!$isActualImpersonatedUser)
                        href="{{ route(config('ail.routes.name') . '.impersonate', ['id' => $user->getKey(), 'guardName' => $actualGuard]) }}"
                    @else
                        href="#"
                    @endif
                >
                    @if($isActualImpersonatedUser)
                        <strong>{{ $user->getKey() }} - {{ $user->getImpersonateName() }}</strong>
                        <a href="{{ route(config('ail.routes.name') . '.impersonate.leave') }}"><button>LEAVE</button></a>
                    @else
                        {{ $user->getKey() }} - {{ $user->getImpersonateName() }}
                    @endif
                </a>
            </li>
        @endif
    @endforeach
</ul>
</body>
</html>
