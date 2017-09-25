@extends('base')

@section('title')
	Data Arsip
@endsection

@section('breadcrumb')
	@parent
	<li>Data Arsip</li>
@endsection

@section('content')     
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <a onclick="addForm()" class="btn btn-success"><i class="fa fa-plus-circle"></i> Tambah</a>
      </div>
      <div class="box-body">  

	<table class="table table-striped">
		<thead>
		   <tr>
		      <th>No.Registrasi</th>
		      <th>Nama</th>
		      <th>Masa Berlaku</th>
          <th>di Tetapkan</th>
		      <th>Status</th>
          <th>Status Pembayaran</th>
		      <th>Aksi</th>
		   </tr>
		</thead>
		<tbody></tbody>
	</table>

      </div>
    </div>
  </div>
</div>
@include('data-arsip.form')
@include('data-arsip.detail')
@endsection

@section('script')

<script type="text/javascript">
var table, save_method;
$(function(){
  $('#masa_berlaku, #start, #end').datepicker({
      format: 'd MM yyyy',
      autoclose: true
   });

   table = $('.table').DataTable({
     "processing" : true,
     "ajax" : {
       "url" : "{{ route('dataarsip') }}",
       "type" : "GET"
     }
   });

  $('#modal-form form').validator().on('submit', function(e){
    if(!e.isDefaultPrevented()){
       var id = $('#id').val();
       if(save_method == "add") url = "{{ route('arsip.store') }}";
       else url = "arsip/"+id;
       
       $.ajax({
         url : url,
         type : "POST",
         data : $('#modal-form form').serialize(),
         success : function(data){
           $('#modal-form').modal('hide');
           table.ajax.reload();
         },
         error : function(){
           alert("Tidak dapat Menyimpan data!");
         }
       });
       return false;
     }
   }); 
});

function addForm(){
   save_method = "add";
   $('input[name=_method]').val('POST');
   $('#modal-form').modal('show');
   $('#modal-form form')[0].reset();            
   $('.modal-title').text('Tambah Data Arsip');
}

function showDetail(id){
    $.ajax({
      url : "arsip/"+id+"/show",
      type : "GET",
      dataType : "JSON",

      success : function(data){
        $('#modal-detail').modal('show');
        $('.modal-title').text('Detail '+data.no_reg);
        $('.no_reg').text(': '+data.no_reg);
        $('.nama').text(': '+data.nama);
        $('.alamat').text(': '+data.alamat);
        $('.masa_berlaku').text(': '+data.masa_berlaku);
        $('.start').text(': '+data.start);
        $('.end').text(': '+data.end);
        $('.status').text(data.status).addClass('label label-default');
        $('.status_pmb').text(data.status_pmb).addClass('label label-default');
      },
      error : function(){
       alert("Tidak dapat menampilkan data!");
     }
    });
}

function editForm(id){
   save_method = "edit";
   $('input[name=_method]').val('PATCH');
   $('#modal-form form')[0].reset();
   $.ajax({
     url : "arsip/"+id+"/edit",
     type : "GET",
     dataType : "JSON",
     success : function(data){
       $('#modal-form').modal('show');
       $('.modal-title').text('Edit Arsip');
       
       $('#id').val(data.id);
       $('#no_reg').val(data.no_reg);
       $('#nama').val(data.nama);
       $('#alamat').val(data.alamat);
       $('#masa_berlaku').val(data.masa_berlaku);
       $('#start').val(data.start);
       $('#end').val(data.end);
       
     },
     error : function(){
       alert("Tidak dapat menampilkan data!");
     }
   });
}

function deleteData(id){
   if(confirm("Apakah yakin data akan dihapus?")){
     $.ajax({
       url : "arsip/"+id,
       type : "POST",
       data : {'_method' : 'DELETE', '_token' : $('meta[name=csrf-token]').attr('content')},
       success : function(data){
         table.ajax.reload();
       },
       error : function(){
         alert("Tidak dapat menghapus data!");
       }
     });
   }
}
</script>
@endsection