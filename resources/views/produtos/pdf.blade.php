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
                <th>#</th>
                <th>Descrição</th>
                <th>Estoque</th>
                <th>Estoque Mín.</th>
                <th>Categoria</th>
                <th>Fornecedor</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <th># {{ $product->code }}</th>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->minimumStock }}</td>
                    <td>{{ $product->category->description }}</td>
                    <td>{{ $product->provider->name }}</td>
                </tr>
            @endforeach
        <tbody>
    </table>
</body>

</html>
