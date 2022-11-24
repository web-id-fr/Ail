<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AIL - Impersonate</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
</head>
<body>

<section class="hero is-primary">
    <div class="hero-body">
        <p class="title">
            IMPERSONATE USERS
        </p>
        <p class="subtitle">
            Change user like a charm
        </p>
    </div>
</section>

<section class="section">
    <div class="container">
        <h2 class="subtitle">GUARDS</h2>

        <div class="tags are-large">
            @foreach($guards as $guard)
                <a href="{{ route(config('ail.routes.name') . '.index', ['guard' => $guard]) }}" @if($guard === $actualGuard) class="active" @endif>
                <span class="tag is-link">
                    {{ $guard }}
                </span>
                </a>
            @endforeach
        </div>
        <h3 class="subtitle">USERS</h3>

        <form action="{{ route(config('ail.routes.name') . '.index', ['guard' => $guard]) }}" method="GET">
            <div class="field has-addons">
                <div class="control">
                    <input class="input" type="text" name="search" placeholder="Find an user" value="{{ $search }}">
                </div>
                <div class="control">
                    <input class="button is-info" type="submit" value="Search">
                </div>
            </div>
        </form>

        <table class="table is-hoverable">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                @php
                    $isActualImpersonatedUser = $isImpersonating && $user->getKey() === $actualUser?->getKey();
                @endphp

                @if(
                    ($impersonateId && $user->getKey() !== $impersonateId)
                    || (!$impersonateId && $user->getKey() !== $actualUser->getKey())
                )
                    <tr>
                        <th>{{ $user->getKey() }}</th>
                        <th>{{ $user->getImpersonateName() }}</th>
                        <th>
                            @if(!$isActualImpersonatedUser)
                                <a href="{{ route(config('ail.routes.name') . '.impersonate', ['id' => $user->getKey(), 'guardName' => $actualGuard]) }}">
                                    <button class="button is-success">IMPERSONATE</button>
                                </a>
                            @else
                                <a href="{{ route(config('ail.routes.name') . '.impersonate.leave') }}">
                                    <button class="button is-danger">LEAVE</button>
                                </a>
                            @endif
                        </th>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>

        {{ $users->links('ail::components.pagination') }}
    </div>
</section>
</body>
</html>
