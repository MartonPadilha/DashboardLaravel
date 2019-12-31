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
            <tr>
                <th>Nome</th>
                <th>Horário</th>
                <th>Quantidade</th>
                <th>Valor</th>
            </tr>

            @foreach ($demands as $demand)
                <tr>
                    <td>{{$demand->name}}</td>
                    <td>{{$demand->timeTake}}</td>
                    <td>{{$demand->quantity}}</td>
                    <td>{{$demand->quantity*30}}</td>
                </tr>
            @endforeach
        </table>
    </body>
    </html>