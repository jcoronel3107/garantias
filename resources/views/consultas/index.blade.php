	@extends( "layouts.plantilla" )

	@section( "cabeza" )

@endsection

@section( "cuerpo" )
	<h1 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Consulta Información de Polizas</h1>
	@can('view estadistica')
		<form>
			{{csrf_field()}}
			<div class="form-row">
				<div class="form-group input-group align-items-left col-md-4">
		            <div class="custom-control custom-radio">
	  					<input type="radio" class="custom-control-input" id="customCheck1" name="consulta" value="1" >
	  					<label class="custom-control-label" for="customCheck1">Contratos Registrados</label>
					</div>
				</div>
				<div class="form-group input-group align-items-left col-md-4">
					<div class="custom-control custom-radio">
	  					<input type="radio" class="custom-control-input" id="customCheck2" name="consulta" value="2">
	  					<label class="custom-control-label" for="customCheck2">Polizas Activas</label>
					</div>
				</div>
				<div class="form-group input-group align-items-left col-md-4">
					<div class="custom-control custom-radio">
	  					<input type="radio" class="custom-control-input" id="customCheck3" name="consulta" value="3">
	  					<label class="custom-control-label" for="customCheck3">Polizas Todas</label>
					</div>
				</div>
		    </div>
		    <div class="form-row">
				<div class="form-group input-group align-items-left col-md-4">
		            <div class="custom-control custom-radio">
	  					<input type="radio" class="custom-control-input" id="customCheck4" name="consulta" value="4">
	  					<label class="custom-control-label" for="customCheck4">Polizas Buen Uso</label>
					</div>
				</div>
				<div class="form-group input-group align-items-left col-md-4">
					<div class="custom-control custom-radio">
	  					<input type="radio" class="custom-control-input" id="customCheck5" name="consulta" value="5">
	  					<label class="custom-control-label" for="customCheck5">Polizas Fiel Cumplimiento</label>
					</div>
				</div>
				<div class="form-group input-group align-items-left col-md-4">
					<div class="custom-control custom-radio">
	  					<input type="radio" class="custom-control-input" id="customCheck6" name="consulta" value="6">
	  					<label class="custom-control-label" for="customCheck6">Polizas Por Afianzado</label>
					</div>
		        </div>
		    </div>
		    <div class="form-row">
				<div class="form-group input-group align-items-left col-md-4">
		            <div class="custom-control custom-radio">
	  					<input type="radio" class="custom-control-input" id="customCheck7" name="consulta" value="7">
	  					<label class="custom-control-label" for="customCheck7">Polizas x vencer 15 dias</label>
					</div>
				</div>
				<div class="form-group input-group align-items-left col-md-4">
					<div class="custom-control custom-radio">
	  					<input type="radio" class="custom-control-input" id="customCheck8" name="consulta" value="8">
	  					<label class="custom-control-label" for="customCheck8">Polizas x vencer 30 dias</label>
					</div>
				</div>

		    </div>
				<hr style="border:2px;">
		</form>
		@push('scripts')
			<script type="text/javascript">
			$(document).ready(function()
			{
	   			 $("input[name=consulta]").click(function () {
	    	    /*alert("La edad seleccionada es: " + $('input:radio[name=consulta]:checked').val());
	    	    alert("La edad seleccionada es: " + $(this).val());*/
	    	    if ($(this).val() == "1") {
	           		 window.location="/consult/contratos/"
	           		};
	           	if ($(this).val() == "2") {
	           		 window.location="/consult/polizas/"
	           		};
	           	if ($(this).val() == "3") {
	           		 window.location="/consult/polizas3/"
	           		};
	           	if ($(this).val() == "4") {
	           		 window.location="/consult/polizas4/"
	           		};
	           	if ($(this).val() == "5") {
	           		 window.location="/consult/polizas5/"
	           		};
	           	if ($(this).val() == "6") {
	           		 window.location="/consult/polizas6/"
	           		};
	           	if ($(this).val() == "7") {
	           		 window.location="/consult/polizas7/"
	           		};
	           	if ($(this).val() == "8") {
	           		 window.location="/consult/polizas8/"
	           		};

	    		});

	        });
	        </script>;
		@endpush
	@else
  			<p>Lo sentimos, No Tienes Permisos de Consulta.</p>
		@endcan
@endsection @section( "piepagina" ) @endsection