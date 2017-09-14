<!DOCTYPE html>
<html>
<head>  
  <title>Data Arsip PDF</title>

  <style type="text/css">
    body{
      font-family: Verdana;
    }
    tbody{
      font-size: 10px;
    }

    thead{
      font-size: 12px;
    }
    .table {
      width: 100%;
      max-width: 100%;
      margin-bottom: 20px;
    }
    .table > thead > tr > th,
    .table > tbody > tr > th,
    .table > tfoot > tr > th,
    .table > thead > tr > td,
    .table > tbody > tr > td,
    .table > tfoot > tr > td {
      padding: 8px;
      line-height: 1.42857143;
      vertical-align: top;
      border-top: 1px solid #ddd;
    }
    .table > thead > tr > th {
      vertical-align: bottom;
      border-bottom: 2px solid #ddd;
    }
    .table > caption + thead > tr:first-child > th,
    .table > colgroup + thead > tr:first-child > th,
    .table > thead:first-child > tr:first-child > th,
    .table > caption + thead > tr:first-child > td,
    .table > colgroup + thead > tr:first-child > td,
    .table > thead:first-child > tr:first-child > td {
      border-top: 0;
    }
    .table > tbody + tbody {
      border-top: 2px solid #ddd;
    }
    .table .table {
      background-color: #fff;
    }
    .table-condensed > thead > tr > th,
    .table-condensed > tbody > tr > th,
    .table-condensed > tfoot > tr > th,
    .table-condensed > thead > tr > td,
    .table-condensed > tbody > tr > td,
    .table-condensed > tfoot > tr > td {
      padding: 5px;
    }
    .table-bordered {
      border: 1px solid #ddd;
    }
    .table-bordered > thead > tr > th,
    .table-bordered > tbody > tr > th,
    .table-bordered > tfoot > tr > th,
    .table-bordered > thead > tr > td,
    .table-bordered > tbody > tr > td,
    .table-bordered > tfoot > tr > td {
      border: 1px solid #ddd;
    }
    .table-bordered > thead > tr > th,
    .table-bordered > thead > tr > td {
      border-bottom-width: 2px;
    }
    table col[class*="col-"] {
      position: static;
      display: table-column;
      float: none;
    }
    table td[class*="col-"],
    table th[class*="col-"] {
      position: static;
      display: table-cell;
      float: none;
    }
    .table-responsive {
      min-height: .01%;
      overflow-x: auto;
    }
     .table-striped > tbody > tr:nth-of-type(odd) {
      background-color: #f9f9f9;
    }
  </style>

</head>
<body>
 
<h3 style="text-align: center;">Data Arsip</h3>
<table class="table table-striped" width="100%">
  <thead>
   <tr>
    <th>No</th>
    <th>No.Registrasi</th>
    <th>Nama</th>
    <th>Alamat</th>
    <th>Masa Berlaku</th>
    <th>di Tetapkan</th>
    <th>Berakhir</th>
    <th>Status</th>
    <th>Status Pembayaran</th>
   </tr>
   </thead>

   <tbody>
    @foreach($dataarsip as $row)    
      @foreach($row as $col)
      <tr>
        <td>{{ ++$no }}</td>
        <td>{{ $col->no_reg }}</td>
        <td>{{ $col->nama }}</td>
        <td>{{ $col->alamat }}</td>
        <td>{{ $col->masa_berlaku }}</td>
        <td>{{ $col->start }}</td>
        <td>{{ $col->end }}</td>
        <?php
          $awal = starts_with($col->no_reg, 'H');
          $end = ends_with($col->no_reg, ['A','P','H','S','F']);
          if ($awal && $end == true) {
              $result = 'LOKAL';
          }else{
              $result = 'ONLINE';
          };
        ?>
        <td>{{ $result }}</td>
        <td>{{ $col->status_pmb }}</td>
      </tr>
      @endforeach
    @endforeach
   </tbody>
</table>

</body>
</html>