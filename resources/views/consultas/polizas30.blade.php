	@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )
		<h1 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Consulta Polizas Fiel Cumplimiento Vigentes</h1>
		<ul class="nav justify-content-end">
		  <li class="nav-item">
		      <a class="btn btn-outline-primary" href="/consultas/">Regresar</a>
		      <a class="btn btn-outline-success" href="/polizas5/export5/">Exporta Excel</a>
		    </li>
		</ul>
		<hr style="border:2px;">
		<table name="resultados" id="resultados" class="table table-hover table-responsive table_condensed">
			<thead>
				<tr class="table-primary">
					<td>Codigo_Poliza</td>
					<td>Valor_Poliza</td>
					<td>Tipo_Poliza</td>
					<td>Vigencia_Desde</td>
					<td>Plazo</td>
					<td>aseguradora_id</td>
					<td>Aseguradora</td>
					<td>contrato_id</td>
					<td>Contrato</td>
					<td>Estado</td>
					<td>Renovacion</td>
					<td>Fecha_Cierre</td>
					<td>created_at</td>
			</thead>
			<tbody>
				@foreach($polizas as $poliza)
				<tr>

					<td>{{$poliza->Codigo_Poliza}}</td>
					<td>USD${{$poliza->Valor_Poliza}}</td>
					<td>{{$poliza->Tipo_Poliza}}</td>
					<td>{{$poliza->Vigencia_Desde}}</td>
					<td>{{$poliza->Plazo}}</td>
					<td>{{$poliza->aseguradora_id}}</td>
					<td>{{$poliza->Razon_Social}}</td>
					<td>{{$poliza->contrato_id}}</td>
					<td>{{$poliza->Codigo_Contrato}}</td>
					<td>{{$poliza->Estado}}</td>
					<td>{{$poliza->Renovacion}}</td>
					<td>{{$poliza->Fecha_Cierre}}</td>
					<td>{{$poliza->created_at}}</td>

				</tr>
				@endforeach
				</tr>
			</tbody>
			</table>
@endsection
@section( "piepagina" ) @endsection