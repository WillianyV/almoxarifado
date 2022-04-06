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
                <th>CNPJ</th>
                <th>Razão Social</th>
                <th>Nome Fantasia</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($companies as $company)
                <tr>
                    <th># {{ $company->cnpj }}</th>
                    <td>{{ $company->corporateName }}</td>
                    <td>{{ $company->fantasyName }}</td>
                </tr>
            @endforeach
        <tbody>
    </table>
</body>

</html>
