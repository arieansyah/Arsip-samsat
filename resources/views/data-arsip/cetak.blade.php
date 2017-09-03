@extends('base')

@section('title')
	Cetak Arsip
@endsection

@section('breadcrumb')
	@parent
	<li>Cetak Arsip</li>
@endsection

@section('content')     
<div class="row">
  <div class="col-xs-12">
    <div class="box">	
      <div class="box-header">
      	<h1>Pilih Status</h1>
      </div>
      <div class="box-body">  
      
		<form method="POST" id="form-member">
	      {{ csrf_field() }}
		    <div class="col-md-2">
			    <div class="checkbox">
					<label>
						<input type="checkbox" name='oke[]' value='ONLINE'> ONLINE
					</label>
			    </div>
			</div>
			<div class="col-md-2">
			    <div class="checkbox">
					<label>
						<input type="checkbox" name='oke[]' value='LOKAL'> LOKAL
					</label>
		      	</div>	      
		    </div>
      	</form> 
      	
      	<div class="col-md-12">
      	<hr>
      		<a onclick="printPDF()" class="btn btn-warning"><i class="fa fa-plus-circle"></i> Export PDF</a>	
      	</div>
      	
	   		

	      
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
	function printPDF(){
	  if($('input:checked').length < 1){
	    alert('Pilih data yang akan dicetak!');
	  }else{
	    $('#form-member').attr('target', '_blank').attr('action', "cetak/arsip").submit();
	  }
	}	
</script>
@endsection