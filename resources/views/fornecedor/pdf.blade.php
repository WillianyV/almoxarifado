<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>CNPJ</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($providers as $provider)
                <tr>
                    <th># {{ $provider->id }}</th>
                    <td>{{ $provider->name }}</td>
                    <td>{{ $provider->cnpj }}</td>
                    <td>{{ $provider->status }}</td>   
                </tr>
            @endforeach
        <tbody>
    </table>
</body>

</html>
