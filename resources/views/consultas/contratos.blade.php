	@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )
		<h1 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Consulta Contratos Registrados</h1>
		<ul class="nav justify-content-end">
		  <li class="nav-item">
		      <a class="btn btn-outline-primary" href="/consultas/">Regresar</a>
		      <a class="btn btn-outline-success" href="/contratos2/export2/">Exporta Excel</a>

		    </li>
		</ul>
		<hr style="border:2px;">
		<table name="resultados" id="resultados" class="table table-hover table-responsive table_condensed">
			<thead>
				<tr class="table-primary">
					<td>Codigo_Contrato</td>
					<td>Nombre_Contrato</td>
					<td>Afianzado</td>
					<td>administrador</td>
					<td>Mail_Administrador</td>
					
					<td>Plazo_Contrato</td>
			</thead>
			<tbody>
				@foreach($contratos as $contrato)
				<tr>

					<td>{{$contrato->Codigo_Contrato}}</td>
					<td>{{$contrato->Nombre_Contrato}}</td>
					
					<td>{{$contrato->afianzado}}</td>
					<td>{{$contrato->administrador}}</td>
					<td>{{$contrato->mail_administrador}}</td>
					
					<td>{{$contrato->Plazo_Contrato}}</td>

				</tr>
				@endforeach
				</tr>
			</tbody>
			</table>
@endsection
@section( "piepagina" ) @endsection