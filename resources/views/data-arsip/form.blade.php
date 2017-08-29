<div class="modal" id="modal-form" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
     
   <form class="form-horizontal" data-toggle="validator" method="post" {{-- action="{{url('arsip')}}" --}}>
   {{ csrf_field() }} {{ method_field('POST') }}
   
   <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"> &times; </span> </button>
      <h3 class="modal-title"></h3>
   </div>
            
<div class="modal-body">
   
   <input type="hidden" id="id" name="id">
   <div class="form-group">
      <label for="no_reg" class="col-md-3 control-label">No Registrasi</label>
      <div class="col-md-6">
         <input id="no_reg" type="text" class="form-control" name="no_reg" placeholder="Masukan No Registrasi" autofocus required>
         <span class="help-block with-errors"></span>
      </div>
   </div>
   <div class="form-group">
      <label for="nama" class="col-md-3 control-label">Nama</label>
      <div class="col-md-6">
         <input id="nama" type="text" class="form-control" name="nama" placeholder="Masukan Nama" autofocus required>
         <span class="help-block with-errors"></span>
      </div>
   </div>
   <div class="form-group">
      <label for="alamat" class="col-md-3 control-label">Alamat</label>
      <div class="col-md-6">
         <input id="alamat" type="text" class="form-control" name="alamat" placeholder="Masukan Alamat" autofocus required>
         <span class="help-block with-errors"></span>
      </div>
   </div>

   <div class="form-group">
      <label for="masa_berlaku" class="col-md-3 control-label">Masa Berlaku</label>
      <div class="col-md-6">
         <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input id="masa_berlaku" type="text" class="form-control" name="masa_berlaku" autofocus required>
          </div>
          <span class="help-block with-errors"></span>
      </div>
   </div>

   <div class="form-group">
      <label for="start" class="col-md-3 control-label">di Tetapkan</label>
      <div class="col-md-6">
         <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input id="start" type="text" class="form-control" name="start" autofocus required>
          </div>
          <span class="help-block with-errors"></span>
      </div>
   </div>
   
</div>

   
   <div class="modal-footer">
      <button type="submit" class="btn btn-primary btn-save"><i class="fa fa-floppy-o"></i> Simpan </button>
      <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Batal</button>
   </div>
      
   </form>

         </div>
      </div>
   </div>
