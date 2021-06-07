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
        <div class="col"><a class="btn btn-primary text-white" href="/ojs">Bosh sahifa</a></div>
        <div class="col-12">
            @foreach($publication->getTitles() as $title)
                <h1 class="text-white">{{ $title }}</h1>
            @endforeach
        </div>
    </div>
    <div class="row">
        <div class="card">
            <div class="">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Publication ID</th>
                        <th>Citation ID</th>
                        <th>Title of cited article</th>

                        <th>Raw Citation</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($citations as $citation)
                        <tr>
                            <td>{{ $citation['publication_id'] }}</td>
                            <td>{{ $citation['citation_id'] }}</td>
                            <td>
                                @foreach($citation['titles'] as $title)
                                    {{ $title }}
                                @endforeach
                            </td>
                            <td>{{ $citation['citation'] }}</td>
                            <td>
{{--                                <form action="{{ url('ojs/citation_delete/'.$citation['citation_id']) }}" method="post">--}}
{{--                                    @csrf--}}
{{--                                    @method('DELETE')--}}
{{--                                    <button type="submit" class="btn btn-danger">O'chirish</button>--}}
{{--                                </form>--}}
                            </td>
                         </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>

</body>
</html>
