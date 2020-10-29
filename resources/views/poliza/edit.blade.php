	@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )
		<h1 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">"Editar Información de Poliza" </h1><h4>Poliza: {{$poliza->Codigo_Poliza}}</h4>
		<hr >
		@can('edit polizas')
			<form method="post" action="/poliza/{{$poliza->id}}">
				@csrf @method('PATCH')
				<div class="form-row">
					{{csrf_field()}}
					<div class="form-group input-group  col-md-6">
						<div class="input-group-prepend">
							<span class="input-group-text">Tipo_Poliza</span>
						</div>
						<select class="form-control selectpicker" name="Tipo_Poliza"  required="">
							<option selected >{{old('Tipo_Poliza',$poliza->Tipo_Poliza)}}</option>
							<option>Buen Uso Anticipo</option>
							<option>Fiel Cumplimiento</option>
						</select>
					</div>
					<div class="form-group input-group  col-md-6">
						<div class="input-group-prepend">
							<span class="input-group-text">Codigo_Poliza</span>
						</div>
						<input type="text" maxlength="50" required="" name="Codigo_Poliza" placeholder="Digite el Codigo de la poliza" class="form-control" value="{{old('Codigo_Poliza',$poliza->Codigo_Poliza)}}">
					</div>
				</div>
				<div class="form-row">
					<div class="form-group input-group  col-md-4">
						<div class="input-group-prepend">
							<span class="input-group-text">Plazo</span>
						</div>
						<input type="number" required="" name="Plazo" placeholder="Digite el plazo de la poliza en dias" class="form-control" value="{{old('Plazo',$poliza->Plazo)}}">
					</div>
					<div class="form-group input-group  col-md-6">
						<div class="input-group-prepend">
							<span class="input-group-text">Aseguradora</span>
						</div>
						<select class="form-control selectpicker" name="Aseguradora" data-live-search="true" required>
							<option selected>{{old('Aseguradora',$poliza->aseguradora->Razon_Social)}}</option>
							@foreach($aseguradoras as $aseguradora)
								<option>{{$aseguradora->Razon_Social}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group input-group  col-md-6">
						<div class="input-group-prepend">
							<span class="input-group-text">Valor_Poliza</span>
						</div>
						<input type="number" required="" step="0.01" name="Valor_Poliza" placeholder="Digite el Valor de la Poliza" class="form-control" value="{{old('Valor_Poliza',$poliza->Valor_Poliza)}}">
					</div>
					<div class="form-group input-group  col-md-6">
						<div class="input-group-prepend">
							<span class="input-group-text">Vigencia_Desde</span>
						</div>
						<input type="input" required="" name="Vigencia_Desde" class="form-control" placeholder="Digite Fecha de emision Poliza" value="{{old('Vigencia_Desde',$poliza->Vigencia_Desde)}}">
					</div>
				</div>
				<div class="form-row">
					<div class="form-group input-group col-md-12">
						<div class="input-group-prepend">
							<span class="input-group-text">Contrato para Asociar</span>
						</div>
						<select class="form-control" required name="Nombre_Contrato">
							<option selected>{{old('Nombre_Contrato',$poliza->contrato->Nombre_Contrato)}}</option>
							@foreach($contratos as $contrat)
								<option>{{$contrat->Nombre_Contrato}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group input-group col-md-4">
						<div class="input-group-prepend">
							<span class="input-group-text">Estado</span>
						</div>
						<select data-toggle="tooltip" data-placement="right" title="Activa=1 Desactiva=0" class="form-control" required id="Estado" name="Estado" onchange="showContent()">
							<option selected>{{old('Estado',$poliza->Estado)}}</option>
							<option value="1">1</option>
							<option value="0">0</option>

						</select>
					</div>
					<div class="form-group input-group col-md-3">
						<div class="input-group-prepend">
								<span class="input-group-text">Renovacion</span>
						</div>
						<select class="form-control" required name="Renovacion">
							<option selected>{{old('Renovacion',$poliza->Renovacion)}}</option>
							<option>1</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
						</select>
					</div>
					<div id="cierre" style="display: none;" class="form-group input-group col-md-4">
						<div  class="input-group-prepend">
								<span class="input-group-text">Fecha Cierre</span>
						</div>
						<input  type="date"  name="Fecha_Cierre" class="form-control" placeholder="Digite Fecha de Cierre Poliza" value="{{old('Fecha_Cierre',$poliza->Fecha_Cierre)}}">
					</div>
				</div>



				<div class="form-group">
					<button type="submit" name="Enviar" value="Enviar" class="btn btn-success">Actualizar</button>

					<a class="btn btn btn-primary" role="button"
						href="{{ route('poliza.index')}}">Cancelar
					</a>
				</div>{{-- Div Botones --}}
			</form>
			<form method="post" action="/poliza/{{$poliza->id}}">
				{{csrf_field()}}
				<input type="hidden" name="_method" value="DELETE">

				<button type="button" class="btn btn-primary btn-danger" data-toggle="modal" data-target="#exampleModal">Eliminar Registro</button>
				<!-- Modal -->
				<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLabel">Confirmación</h5>
				        <button type="button"  class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				        <p>El registro seleccionado será eliminado. Esta Seguro?...</p>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				        <button  type="submit" name="Eliminar" value="Eliminar" class="btn btn-primary">Ok</button>
				      </div>
				    </div>
				  </div>
				</div>
			</form>
			@if(count($errors)>0)
				@foreach($errors->all() as $error)
					<div class="alert alert-danger" role="alert">{{$error}}
					</div>
				@endforeach
			@endif
			@push('scripts')
				<script  >
				    function showContent() {
				        element = document.getElementById("cierre");
				        getSelectValue  = document.getElementById("Estado").value;
				        if (getSelectValue == "0") {
				            element.style.display='flex';
				        }
				        else {
				            element.style.display='none';
				        }
				    }
				</script>
			@endpush('scripts')
		@else
  			<p>Lo sentimos, No Tienes Permisos de Edición.</p>
		@endcan
	@endsection

	@section( "piepagina" )


	@endsection