	@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )

	<h1 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Registro Información de Afianzado</h1>
	@can('create afianzados')
		<form method="post" action="/afianzado">
			<div class="form-row">
					<div class="form-group input-group  col-md-8">
						<div class="input-group-prepend">
							<span class="input-group-text">Nombres Completos</span>
						</div>
						<input type="text" value="{{old('afianzado')}}" required="" name="afianzado" placeholder="Digite Nombres Completos / Razòn Social del Afianzado" class="form-control"> {{csrf_field()}}
					</div>
			</div>
			<div class="form-row">
				<div class="form-group input-group col-md-8">
						<div class="input-group-prepend">
							<span class="input-group-text">Ruc / C.I.</span>
						</div>
						<input type="text" value="{{old('ruc')}}" required="" name="ruc" class="form-control" placeholder="Digite RUC/CI de Afianzado">
					</div>
			</div>
			<div class="form-row">
				<div class="form-group input-group  col-md-8">
					<div class="input-group-prepend">
							<span class="input-group-text">Direccion</span>
					</div>
					<input type="text" value="{{old('direccion')}}" required="" name="direccion" class="form-control" placeholder="Digite Dirección del Afianzado">
				</div>
			</div>
			<div class="form-row">
				<div class="form-group  input-group col-md-8">
						<div class="input-group-prepend">
							<span class="input-group-text">E.Mail</span>
						</div>
						<input type="email" value="{{old('mail')}}" required="" name="mail" class="form-control" placeholder="john@example.net">
					</div>
			</div>
			<div class="form-group">
					<button type="submit" name="Enviar" value="Enviar" class="btn btn-success">Registrar</button>
					<a class="btn btn btn-primary" role="button"
						href="{{ route('afianzado.index')}}">Cancelar
					</a>
					<button type="reset" name="Borrar" value="Borrar" class="btn btn-danger">Borrar Formulario</button>
			</div>
		</form>
		@if(count($errors)>0)
			@foreach($errors->all() as $error)
				<div class="alert alert-danger" role="alert">
				{{$error}}
				</div>
			@endforeach
		@endif
	@else
  		<p>Lo sentimos, No Tienes Permisos de Creación.</p>
	@endcan
@endsection
@section( "piepagina" )
@endsection