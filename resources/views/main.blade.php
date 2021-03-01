<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"/>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>
<body>
	<div class="content">
		<div class="container-fluid">
            <div class="row">
            	<div class="row" style="background: #5bc0de">
            		<h4 style="text-align: center;color: #FFFFFF;"><strong>Control de Ordenes y Recibos</strong></h4>
            	</div>
            	<div class="row">
            		<h4 style="color: transparent;">-----</h4>
            	</div>
            </div>
            <div class="container-fluid">
            @php
		         $count=0;;
		    @endphp
            @for($i = 0; $i < ($data['modulo']); $i++)
            	<div class="row">
	            @for($x = 1; $x < 4; $x++)
	            	<div class="col-md-3 bg-primary">
		            	<div class="card-header bg-success"> 
		            		<strong style="color: #FF0000">{{$data['headers'][$count]['receipt_number']}}</strong>
		            		<strong style="color: #000000">{{$data['headers'][$count]['customer_id']}}</strong>
		            	</div>
		         	   	<div class="card-body">
		            		@foreach( $data['body'] as $item)
		            			@if( $item['ref_id_header'] == $data['headers'][$count]['id'])
		            				<dl style="border: black 1px solid;">
		            					<dt style="text-align: center;">{{$item['quantity']}} => {{$item['item_name']}} = {{$item['price']}}U$</dt>
		            					<p>{{$item['line_note']}}</p>
		            				</dl>
		            			@endif
		            		@endforeach
		            		<dl style="border: black 1px solid;">
            					<p>{{$data['headers'][$count]['note']}}</p>
            				</dl>
		            		<dl style="text-align: right;">  
		            			<dl>Impuesto <strong>{{$data['headers'][$count]['total_tax']}}</strong>U$</dl>
		            			<dl>Descuento <strong>{{$data['headers'][$count]['total_discount']}}</strong>U$</dl>
		            			<dl>Total <strong>{{$data['headers'][$count]['total_money']}}</strong>U$</dl>
		            			<dl>Total <strong>{{$data['headers'][$count]['total_money']}}</strong>U$</dl>
		            		</dl>
		            	</div>
		            	<div class="card-footer">
		            		<form method="POST" action="{{route('card_admin')}}">@csrf	
		            			<input type="" name="id" value="{{$data['headers'][$count]['id']}}" hidden="true" readonly="true">
		            			<div class="col-md-4">
		            				<button type="submit" class="btn btn-warning far fa-eye" name="show">	Ver</button>
		            			</div><div class="col-md-4"></div>
		            			<div class="col-md-4">
		            				<button type="submit"class="btn btn-success far fa-thumbs-up" name="check">	Check</button>
		            			</div>
		            		</form>
		            	</div><br><br>	
		            </div><div class="col-md-1"></div>
	            	@php
	            		$count++;
	            	@endphp
		            @if( ($data['max']-$count) == 0 )
		            	@php
		            		$x = 5;
		            	@endphp  	
		            @endif
	            @endfor
	            </div><div class="row"><small style="color: transparent;">---</small></div>
            @endfor
           	</div>
        </div>  
	</div>
</body>
<footer>
	<script src="{{ asset('js/jquery.3.2.1.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
	<script type="text/javascript">
		 $(document).ready(function(){
    		setTimeout(refrescar, 15000);
  		});
		function refrescar(){
    		location.reload();
  		}
	</script>
</footer>
</html>