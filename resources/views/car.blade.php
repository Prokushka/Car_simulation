<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Car</title>
    <style>
        .form{
            display: flex;
            justify-content: left;


        }
        form{
            margin-left: 15px;
        }
    </style>
</head>
<body>
<div>

    <ul>
        <li>
            Y have a key: {{$user->throughKey->is_have ? 'yes' : 'no' }}
            <form action="{{route('get.key', $user->throughKey->id)}}" method="POST">
                @method('patch')
                @csrf
                <input type="submit" value="{{$user->throughKey->is_have ? 'lost a key' : 'give a key'}}">
            </form>

        </li>
        @if($user->car->statement_car == 'stop')
        <li>
            Door is {{$user->car->isOpenDoor ? 'open' : 'close'}}
            <form action="{{$user->car->isOpenDoor ? route('close.door', ['user' => $user]) : route('open.door', ['user' => $user])}}" method="POST">
                @method('patch')
                @csrf
                <input type="submit" value="{{$user->car->isOpenDoor ? 'close' : 'open'}}">
            </form>
        </li>
        <li>
            Statement your car: {{$user->car->isTurn ? 'Turn' : 'Sleep'}}
            <form action="{{$user->car->isTurn ? route('sleep.car', ['user' => $user]) : route('turn.car', ['user' => $user]) }}" method="POST">
                @method('patch')
                @csrf
                <input type="submit" value="{{$user->car->isTurn ? 'Sleep' : 'Turn'}}">
            </form>
        </li>
        @endif
        @if($user->car->isTurn == 1)
            <li>
                Your speed: {{$user->car->speed}}km/h
            </li>
            <li>
                Odometer: {{$user->car->odometer}}km
            </li>
            <li>
                Left Window: {{$user->car->leftWindow}}%
                Right Window: {{$user->car->rightWindow}}%
                <div class="form">


                    <form action="{{route('raises.window', $user)}}" method="POST">
                        @csrf
                        @method('patch')
                        <label>Choose window</label>
                        <select name="place">
                            <option value="left">Left window</option>
                            <option value="right" selected>right window</option>
                        </select>
                        <input type="submit" value="Rise window">
                    </form>
                    <form action="{{route('lower.window', $user) }}" method="POST">
                        @csrf
                        @method('patch')
                        <select name="place">
                            <option value="left">Left window</option>
                            <option value="right" selected>right window</option>
                        </select>
                        <input type="submit" value="Lower window">
                    </form>
                </div>
            </li>
            <li>
                You listen: {{$user->car->entertainment_Unit ? $user->car->entertainment_Unit : 'nothing'}}
                @if($user->car->statement_car == 'stop')
                <form action="{{route('listen.radio', $user)}}" method="POST">
                    @method('patch')
                    @csrf
                    <input type="submit" value="{{$user->car->entertainment_Unit == 'radio' ? 'stop it' : 'Listen Radio'}}">
                </form>
                <form action="{{route('listen.cd', $user) }}" method="POST">
                    @method('patch')
                    @csrf
                    <input type="submit" value="{{$user->car->entertainment_Unit == 'cd' ? 'stop it' : 'Listen Cd'}}">
                </form>
                <form action="{{route('listen.spotify', $user) }}" method="POST">
                    @method('patch')
                    @csrf
                    <input type="submit" value="{{$user->car->entertainment_Unit == 'spotify' ? 'stop it' : 'Listen Spotify'}}">
                </form>
                @endif
            </li>
            <li>
                Your fuel: {{$user->car->fuel}}
                @if($user->car->fuel < 1)
                <form action="{{route('add.fuel', $user) }}" method="POST">
                    @method('patch')
                    @csrf
                    <select name="fuel">
                        <option value="0.1">0.1</option>
                        <option value="0.2">0.2</option>
                        <option value="0.3">0.3</option>
                        <option value="0.4">0.4</option>
                        <option value="0.5">0.5</option>
                        <option value="0.6">0.6</option>
                        <option value="0.7">0.7</option>
                        <option value="0.8">0.8</option>
                        <option value="0.9">0.9</option>
                        <option value="1">1</option>

                    </select>
                    <input type="submit" value="add Fuel">
                </form>
                @endif
            </li>
            <li>
                Your statement: {{$user->car->statement_car}}
                <form action="{{route('drive', $user)}}" method="POST">
                    @method('patch')
                    @csrf
                    <input type="hidden" name="stmt" value="drive">
                    <input type="submit" value="drive">
                </form>
                <form action="{{route('stop', $user)}}" method="POST">
                    @method('patch')
                    @csrf
                    <input type="hidden" name="stmt" value="stop">
                    <input type="submit" value="stop">
                </form>
            </li>

        @endif

    </ul>

</div>
</body>
</html>
