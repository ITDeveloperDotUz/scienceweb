<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mualliflar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">

</head>
<body class="bg-dark">
    <div class="container">
        <div class="row">
            <h1 class="text-white">Mulliflar</h1>
        </div>
        <div class="row">
            {{ $users->links() }}
            <table class="table table-striped bg-light">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Ism sharif</th>
                    <th>login</th>
                    <th>email</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                <tr>

                    <td>{{ $user->user_id }}</td>
                    <td>
                        @foreach($user->localizedSettings() as $setting)
                            {{ $setting['givenName'] ?? '' }} {{ $setting['familyName'] ?? '' }}<br>
                        @endforeach
                    </td>
                    <td><a href="/ojs/user/{{ $user->username }}">{{ $user->username }}</a></td>
                    <td>{{ $user->email }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
            {{ $users->links() }}
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>

</body>
</html>
