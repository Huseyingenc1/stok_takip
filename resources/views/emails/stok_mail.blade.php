<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Toplu Sipariş Listesi</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            font-family: Arial, sans-serif;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        h2 {
            font-family: Arial, sans-serif;
        }
    </style>
</head>

<body>
    <h2>Toplu Sipariş Listesi (Bugüne Ait)</h2>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Marka Adı</th>
                <th>Model</th>
                <th>KW Değeri</th>
                <th>Güncel Sipariş Adedi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($alert as $geneli)
                <tr>
                    <td>{{ $geneli->id }}</td>
                    <td>{{ $geneli->urun_adi }}</td>
                    <td>{{ $geneli->model }}</td>
                    <td>{{ $geneli->kw }}</td>
                    <td>{{ $geneli->guncel_siparis_adedi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
