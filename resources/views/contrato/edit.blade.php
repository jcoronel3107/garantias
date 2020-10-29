	@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )
		<h1 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Editar Información de Contrato</h1>

		@can('edit contratos')
			<form method="post" action="/contrato/{{$contrato->id}}">
				@csrf @method('PATCH')
				<div class="form-row">

					<div class="form-group  input-group col-md-6">
						<div class="input-group-prepend">
							<span class="input-group-text">Codigo_Contrato</span>
						</div>
						<input type="text" required="" name="Codigo_Contrato" value="{{old('Codigo_Contrato',$contrato->Codigo_Contrato)}}" class="form-control" id="Codigo_Contrato" placeholder="Digite Codigo Contrato">
					</div>
				</div>
				<div class="form-row">
					<div class="form-group input-group  col-md-8">
						<div class="input-group-prepend">
							<span class="input-group-text">Nombre_Contrato</span>
						</div>
						<input type="text" required="" name="Nombre_Contrato" value="{{old('Nombre_Contrato',$contrato->Nombre_Contrato)}}" class="form-control" id="Nombre_Contrato" placeholder="Digite Nombre Contrato">
					</div>
				</div>
				<div class="form-row">
					<div class="form-group input-group col-md-6">
						<div class="input-group-prepend">
							<span class="input-group-text">Plazo_Contrato</span>
						</div>
						<input type="number" required="" value="{{old('Plazo_Contrato',$contrato->Plazo_Contrato)}}" name="Plazo_Contrato" class="form-control" id="Plazo_Contrato" placeholder="Digite Plazo_Contrato">
					</div>
					<div class="form-group input-group col-md-6">
						<div class="input-group-prepend">
							<span class="input-group-text">Fecha_Suscripcion</span>
						</div>
						<input type="input" required="" name="Fecha_Suscripcion" value="{{old('Fecha_Suscripcion',$contrato->Fecha_Suscripcion)}}" class="form-control" id="Fecha_Suscripcion" placeholder="Digite Fecha_Suscripcion">
					</div>
				</div>
				<div class="form-row">
					<div class="form-group input-group col-md-8">
						<div class="input-group-prepend">
							<span class="input-group-text">Afianzado</span>
						</div>
						<select class="form-control" name="afianzado_id">
							<option value="{{$contrato->afianzado->id}}" selected="{{$contrato->afianzado->afianzado}}">{{$contrato->afianzado->afianzado}} </option>
							@foreach($afianzados as $user)
								<option value="{{$user->id}}">{{$user->afianzado}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group input-group col-md-8">
						<div class="input-group-prepend">
							<span class="input-group-text">Administrador</span>
						</div>
						<input type="input" value="{{old('administrador',$contrato->administrador)}}" required="" name="administrador" class="form-control" placeholder="Digite Nombres Completos del Administrador">
					</div>
						
				
				</div>
				<div class="form-row">
					<div class="form-group input-group  col-md-8">
						<div class="input-group-prepend">
							<span class="input-group-text">Mail_administrador</span>
						</div>
						<input type="email" value="{{old('mail_administrador',$contrato->mail_administrador)}}" required="" name="mail_administrador" class="form-control" placeholder="Digite eMail del Administrador">
					</div>
				</div>
				<div class="form-row">
					<div class="form-group input-group col-md-4">
						<div class="input-group-prepend">
							<span class="input-group-text">Numero_Partida</span>
						</div>
						<input type="text" value="{{old('Numero_Partida',$contrato->Numero_Partida)}}" required="" name="Numero_Partida" class="form-control" placeholder="Digite Numero_Partida">
					</div>
					<div class="form-group input-group col-md-8">
						<div class="input-group-prepend">
							<span class="input-group-text">Nombre_Partida</span>
						</div>
						<input type="text" value="{{old('Nombre_Partida',$contrato->Nombre_Partida)}}" name="Nombre_Partida" class="form-control" id="Nombre_Partida" placeholder="Digite Nombre_Partida">
					</div>
				</div>
				<div class="form-row">
					<div class="form-group input-group col-md-12">
						<div class="input-group-prepend">
							<span class="input-group-text">Observaciones</span>
						</div>
						<input type="text" value="{{old('Observaciones',$contrato->Observaciones)}}" name="Observaciones" class="form-control" id="Observaciones" placeholder="Digite Observaciones">
					</div>
				</div>
				<div class="form-row">
					<div class="form-group input-group col-md-3">
						<div class="input-group-prepend">
							<span class="input-group-text">Estado</span>
						</div>
						<select class="form-control" id="Estado" name="Estado" required="" >
							<option selected="Activo" value="1">Activo</option>
							<option value="0">Pasivo</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<button type="submit" name="Enviar" value="Enviar" class="btn btn-success">Actualizar</button>

					<a class="btn btn btn-primary" role="button"
						href="{{ route('contrato.index')}}">Cancelar
					</a>
				</div>
			</form>
			<form method="post" action="/contrato/{{$contrato->id}}">
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
					<div class="alert alert-danger" role="alert">{{$error}}</div>
				@endforeach
			@endif
		@else
  			<p>Lo sentimos, No Tienes Permisos de Edición.</p>
		@endcan
	@endsection

	@section( "piepagina" )


	@endsection