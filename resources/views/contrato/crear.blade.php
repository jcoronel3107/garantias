	@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )
		<h1 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Registro Información de Contratos</h1>
		@can('create contratos')
			<form method="post" action="/contrato">

				<div class="form-row">
					{{csrf_field()}}
					<div class="form-group  input-group col-md-6">
						<div class="input-group-prepend">
							<span class="input-group-text">Codigo_Contrato</span>
						</div>
						<input type="text" required="" name="Codigo_Contrato" class="form-control" id="Codigo_Contrato" placeholder="Digite Codigo Contrato">
					</div>
				</div>
				<div class="form-row">
					<div class="form-group input-group  col-md-10">
						<div class="input-group-prepend">
							<span class="input-group-text">Nombre_Contrato</span>
						</div>
						<input type="text" required=""  name="Nombre_Contrato" class="form-control" id="Nombre_Contrato" placeholder="Digite Nombre Contrato">
					</div>
				</div>
				<div class="form-row">
					<div class="form-group input-group col-md-6">
						<div class="input-group-prepend">
							<span class="input-group-text">Plazo_Contrato</span>
						</div>
						<input type="number" required=""  name="Plazo_Contrato" class="form-control" id="Plazo_Contrato" placeholder="Digite Plazo_Contrato">
					</div>
					<div class="form-group input-group col-md-6">
						<div class="input-group-prepend">
							<span class="input-group-text">Fecha_Suscripcion</span>
						</div>
						<input type="date" required=""  name="Fecha_Suscripcion" min="1979-12-31" class="form-control" id="Fecha_Suscripcion">
					</div>
				</div>
				<div class="form-row">
					<div class="form-group input-group col-md-8">
						<div class="input-group-prepend">
							<span class="input-group-text">Afianzado</span>
						</div>
						<select required="" class="form-control" id="afianzado_id" name="afianzado_id" >
							@foreach($afianzados as $user)
								<option>{{$user->afianzado}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group input-group col-md-8">
						<div class="input-group-prepend">
							<span class="input-group-text">Administrador</span>
						</div>
						<input type="text" maxlength="60" required="" name="administrador" class="form-control" placeholder="Digite Nombre Completo Administrador Contrato">
					</div>
				</div>
				<div class="form-row">
					<div class="form-group input-group  col-md-8">
						<div class="input-group-prepend">
							<span class="input-group-text">Mail_administrador</span>
						</div>
						<input type="email" required="" name="mail_administrador" class="form-control" placeholder="john@example.net">
					</div>
				</div>
				<div class="form-row">
					<div class="form-group input-group col-md-4">
						<div class="input-group-prepend">
							<span class="input-group-text">Numero_Partida</span>
						</div>
						<input type="text" required=""  name="Numero_Partida" class="form-control" placeholder="Digite Numero_Partida">
					</div>
					<div class="form-group input-group col-md-8">
						<div class="input-group-prepend">
							<span class="input-group-text">Nombre_Partida</span>
						</div>
						<input type="text" name="Nombre_Partida" class="form-control" id="Nombre_Partida" placeholder="Digite Nombre_Partida">
					</div>
				</div>
				<div class="form-row">
					<div class="form-group input-group col-md-12">
						<div class="input-group-prepend">
							<span class="input-group-text">Observaciones</span>
						</div>
						<input type="text" name="Observaciones" class="form-control" id="Observaciones" placeholder="Digite Observaciones">
					</div>
				</div>
				<div class="form-row">
					<div class="form-group input-group col-md-3">
						<div class="input-group-prepend">
							<span class="input-group-text">Estado</span>
						</div>
						<select class="form-control" id="Estado" name="Estado" disabled="true" >
							<option selected="Activo" value="1">Activo</option>
							<option value="0">Pasivo</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<button type="submit" name="Enviar" value="Enviar" class="btn btn-success">Registrar</button>
					<a class="btn btn btn-primary" role="button"
						href="{{ route('contrato.index')}}">Cancelar
					</a>
					<button type="reset" name="Borrar" value="Borrar" class="btn btn-danger">Borrar Formulario</button>
				</div>
			</form>

			@if(count($errors)>0)
				@foreach($errors->all() as $error)
					<div class="alert alert-danger" role="alert">{{$error}}</div>
				@endforeach
			@endif
		@else
  			<p>Lo sentimos, No Tienes Permisos de Creación.</p>
		@endcan
@endsection @section( "piepagina" ) @endsection