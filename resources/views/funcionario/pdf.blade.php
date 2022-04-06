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
                <th>Código</th>
                <th>Nome</th>
                <th>Setor</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
                <tr>
                    <th># {{ $employee->code }}</th>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->role->description }}</td>
                </tr>
            @endforeach
        <tbody>
    </table>
</body>

</html>
