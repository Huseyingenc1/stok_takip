  @extends('layout')
  @section('content')
      <!DOCTYPE html>
      <html>

      <head>
          <meta charset="utf-8">
          <title>Stok Takip</title>
          <style>
              body {
                  font-family: DejaVu Sans, sans-serif;
                  font-size: 12px;
              }

              table {
                  width: 100%;
                  border-collapse: collapse;
                  margin-top: 20px;
              }

              th,
              td {
                  border: 1px solid #000;
                  padding: 8px;
                  text-align: left;
              }
          </style>
      </head>

      <body>
          <h2>Stok Takip Raporu ({{ \Carbon\Carbon::now()->format('d.m.Y') }})</h2>
          <table>
              <thead>
                  <tr>
                      <th>Stok Adı</th>
                      <th>Stok Kayıt Tarihi</th>
                  </tr>
              </thead>
              <tbody>
                  @if (isset($stp) && $stp->count())
                      @foreach ($stp as $item)
                          <tr>
                              <td>
                                  <a href="{{ asset('storage/' . $item->dosya_yolu) }}" download>{{ $item->pdf_adi }}</a>
                              </td>
                              <td>{{ \Carbon\Carbon::parse($item->pdf_tarihi)->format('d.m.Y') }}</td>
                          </tr>
                      @endforeach
                  @endif
              </tbody>
          </table>
      </body>

      </html>
  @endsection
