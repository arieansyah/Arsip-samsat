<!DOCTYPE html>
<html>
<head>  
  <title>Data Arsip PDF</title>

  <style type="text/css">
  .container {
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto;
      }
    }
  </style>

</head>
<body>
 
  <h3 style="text-align: center;">{{ $arsip->no_reg }}</h3>
  <table>
    <tr>
      <td>No Registrasi</td>
      <td>: <strong>{{ $arsip->no_reg }}</strong></td>
    </tr>
    <tr>
      <td>Nama</td>
      <td>: {{ ucfirst($arsip->nama) }}</td>
    </tr>
    <tr>
      <td>Tanggal Bayar</td>
      <td>: {{ $arsip->masa_berlaku }}</td>
    </tr>
    <tr>
      <td>di Tetapkan</td>
      <td>: {{ $arsip->start }}</td>
    </tr>
    <tr>
      <td>Berakhir</td>
      <td>: {{ $arsip->end }}</td>
    </tr>
    <tr>
      <td>Status</td>
      <td>: {{ $arsip->status }}</td>
    </tr>
    <tr>
      <td>Status Pembayaran</td>
      <td>: {{ strtoupper($arsip->status_pmb) }}</td>
    </tr>
  </table>

<p><h1 style="float: right;">
  {{ strtoupper($arsip->status_pmb) }}
</h1></p>
</body>
</html>