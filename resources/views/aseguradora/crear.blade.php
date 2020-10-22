	@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )
		<h1 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Registro Información de Aseguradora</h1>
		@can('create aseguradora')
			<form method="post" action="/aseguradora">
				<div class="form-row">
					{{csrf_field()}}
					<div class="form-group input-group  col-md-6">
						<div class="input-group-prepend">
							<span class="input-group-text">Razon Social</span>
						</div>
						<input type="text" maxlength="100" required="" name="Razon_Social" placeholder="Digite la Razón Social" class="form-control">
					</div>
					<div class="form-group input-group  col-md-6">
						<div class="input-group-prepend">
							<span class="input-group-text">Ruc</span>
						</div>
						<input type="text" maxlength="13" name="Ruc" placeholder="Digite el Ruc" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<button type="submit" name="Enviar" value="Enviar" class="btn btn-success">Registrar</button>
					<a class="btn btn btn-primary" role="button"
						href="{{ route('aseguradora.index')}}">Cancelar
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