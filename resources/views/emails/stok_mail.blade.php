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

        .button {
            border: none;
            color: white;
            padding: 16px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            transition-duration: 0.4s;
            cursor: pointer;
        }

        .button1 {
            background-color: white;
            color: black;
            border: 2px solid #008CBA;
            border-radius: 30px
        }

        .button1:hover {
            color: #fff;
            background-color: #008CBA;
            border-color: #008CBA;
            box-shadow: 0 0.125rem 0.25rem 0 #008CBA;
            transform: translateY(-1px);
        }

        .button2 {
            background-color: white;
            color: black;
            border: 2px solid #e6381a;
            border-radius: 30px
        }

        .button2:hover {
            background-color: #e6381a;
            color: white;
        }
    </style>
</head>

<body>
    <h2>Toplu Sipariş Listesi ({{ now()->format('d.m.Y') }} Tarihine Ait)</h2>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Marka Adı</th>
                <th>Model</th>
                <th>KW Değeri</th>
                <th>Güncel Sipariş Adedi</th>
                <th>Sipariş Eden Kişi</th>
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
                    <td>{{ auth()->user()->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div style="text-align: center;margin-top: inherit;">
        {{-- <a class="button button2" href="##">Sipariş İptal Et</a> --}}
        <a href="{{ route('siparis.onayla', ['ids' => implode(',', $ids)]) }}" class="button button1" id="onaylaBtn"
            onclick="siparisiOnayla(event)">
            Siparişi Onayla
        </a>
    </div>
    <div id="siparisOnayNotu" style="margin-top: 10px; color: green; font-weight: bold;"></div>


    <script>
        function siparisiOnayla(e) {
            e.preventDefault(); // Buton tıklanınca yönlendirme durdur

            const buton = document.getElementById('onaylaBtn');
            const notAlani = document.getElementById('siparisOnayNotu');
            const link = buton.getAttribute('href');

            // Notu göster
            notAlani.textContent = "✅ Bu seçim onaylanmıştır.";

            // Butonu devre dışı bırak
            buton.classList.add('disabled');
            buton.style.pointerEvents = 'none';
            buton.style.opacity = 0.5;

            // Sayfayı yönlendir
            window.location.href = link;
        }
    </script>




</body>

</html>
