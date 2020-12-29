	@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )
		<h1 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Registro Información de Polizas</h1>
		@can('create polizas')
			<form method="post" action="/poliza">
				<div class="form-row">
					{{csrf_field()}}
					<div class="form-group input-group col-md-3 col-sm-6">
						<div class="input-group-prepend">
								<span class="input-group-text">Es Renovacion?</span>
						</div>
						<select class="form-control" required="" onchange="habilitar(this.value);" id="qrenov" name="qrenov">
							<option value="" ></option>
							<option value="1">SI</option>
							<option value="2">NO</option>
						</select>
					</div>
					<div class="form-group input-group col-md-3 col-sm-6">
						<div class="input-group-prepend">
								<span class="input-group-text"># Renovacion</span>
						</div>
						<select  class="form-control" id="Renovacion" name="Renovacion">
							<option value="" selected>Seleccione...</option>
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
						</select>
					</div>
					
					
				</div>
				<div class="form-row">
					<div class="form-group input-group  col-md-3">
						<div class="input-group-prepend">
							<span class="input-group-text">Codigo_Poliza</span>
						</div>
						<input type="text" required="" maxlength="50" name="Codigo_Poliza" placeholder="Digite el Codigo de la poliza" class="form-control">
					</div>
					<div class="form-group input-group  col-md-3">
						<div class="input-group-prepend">
							<span class="input-group-text">Tipo_Poliza</span>
						</div>
						<select class="form-control" required="" name="Tipo_Poliza">
							<option value=""></option>
							<option>Buen Uso Anticipo</option>
							<option>Fiel Cumplimiento</option>
						</select>
					</div>
					
				</div>
				<div class="form-row">
					<div class="form-group input-group col-md-12">
						<div class="input-group-prepend">
							<span class="input-group-text">Contrato para Asociar</span>
						</div>
						<select class="form-control" required=""  name="contrato_id">
						<option value=""></option>
							@foreach($contratos as $contrato)
								<option value="{{$contrato->id}}">{{$contrato->Nombre_Contrato}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group input-group  col-md-4">
						<div class="input-group-prepend">
							<span class="input-group-text">Plazo</span>
						</div>
						<input type="number" required="" name="Plazo" placeholder="Digite el plazo de la poliza en dias" class="form-control">
					</div>
					<div class="form-group input-group  col-md-6">
						<div class="input-group-prepend">
							<span class="input-group-text">Aseguradora</span>
						</div>
						<select class="form-control selectpicker" name="Aseguradora" data-live-search="true" required="">
							<option value=""></option>
							@foreach($aseguradoras as $aseguradora)
								<option value="{{$aseguradora->id}}">{{$aseguradora->Razon_Social}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group input-group  col-md-6">
						<div class="input-group-prepend">
							<span class="input-group-text">Valor_Poliza</span>
						</div>
						<input type="number" required="" step="0.01" name="Valor_Poliza" placeholder="Digite el Valor de la Poliza" class="form-control">
					</div>
					<div class="form-group input-group  col-md-6">
						<div class="input-group-prepend">
							<span class="input-group-text">Vigencia_Desde</span>
						</div>
						<input type="date" required="" name="Vigencia_Desde" class="form-control" placeholder="Digite Fecha de emision Poliza">
					</div>
				</div>
				
				<div class="form-row">
					<div class="form-group input-group col-md-3">
						<div class="input-group-prepend">
							<span class="input-group-text">Estado</span>
						</div>
						<input type="text" disabled name="Estado" class="form-control" value="Activa">
					</div>
					
				</div>
				<div class="form-group">
					<button type="submit" name="Enviar" value="Enviar" class="btn btn-success">Registrar</button>
					<a class="btn btn btn-primary" role="button"
						href="{{ route('poliza.index')}}">Cancelar
					</a>
					<button type="reset" name="Borrar" value="Borrar" class="btn btn-danger">Borrar Formulario</button>
				</div> {{-- Div Botones --}}
			</form>

			@if(count($errors)>0)
				@foreach($errors->all() as $error)
					<div class="alert alert-danger" role="alert">{{$error}}</div>
				@endforeach
			@endif
		 @push('scripts')
    		<script type="text/javascript">
    			function habilitar(value)
				{		
					if(value=="1" || value==true)
					{
						// habilitamos
						document.getElementById("Renovacion").required=true;
						document.getElementById("Renovacion").disabled=false;
						
					}else if(value=="2" || value==false){
						// deshabilitamos
						//document.getElementById("Renovacion").value=0;
						$('#Renovacion').value(0);
						document.getElementById("Renovacion").required=false;
						//document.getElementById("Renovacion").disabled=true;
					}
				}
    		</script>
    	 @endpush('scripts')
		@else
  			<p>Lo sentimos, No Tienes Permisos de Creación.</p>
		@endcan

@endsection @section( "piepagina" ) @endsection