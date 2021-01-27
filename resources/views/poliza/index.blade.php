	@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )
		<h1 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Consulta Información de Polizas</h1>
		@include('poliza.messages')
		
		<ul class="nav justify-content-end">
		  <li class="nav-item">
		      <a class="btn btn-outline-danger" href="poliza/create">Nuevo</a>
		      <a class="btn btn-outline-success" href="polizas/export/">Exporta Excel</a>
		      <a class="btn btn-outline-success" href="polizas/grafic/">Grafica</a>
		    </li>
		</ul>
		<hr style="border:2px;">
		@include('poliza.search')
		<table class="table table-hover table-responsive table_condensed">
			<thead>
				<tr class="table-primary">
					<td>Opciones</td>
					
					<td>Codigo_Poliza</td>
					<td>Valor_Poliza</td>
					<td>Tipo_Poliza</td>
					<td>Vigencia_Desde</td>
					<td>Plazo</td>
					<td>Aseguradora</td>
					<td>Afianzado</td>
					<td>Codigo_Contrato</td>
					<td>Nombre_Contrato</td>
					<td>Estado</td>
					<td>Renovacion</td>
					<td>Vigecia_Hasta</td>
					<td>Dias_Restantes</td>
					
			</thead>
			<tbody>
				@foreach($polizas as $poliza)
				<tr>
					<td>
						<a class="btn btn-outline-danger " href="{{route('poliza.edit',$poliza->id)}}" role="button"><i class="far fa-edit"></i></a>

						<a class="btn btn-outline-danger" href="poliza/notificar/{{$poliza->id}}" role="button"><i class="fa fa-paper-plane" aria-hidden="true"></i></a>
					</td>
					
					<td>{{$poliza->Codigo_Poliza}}</td>
					<td>USD${{$poliza->Valor_Poliza}}</td>
					<td>{{$poliza->Tipo_Poliza}}</td>
					<td>{{$poliza->Vigencia_Desde}}</td>
					<td>{{$poliza->Plazo}}</td>
					<td>{{$poliza->Razon_Social}}</td>
					<td>{{$poliza->afianzado}}</td>
					<td>{{$poliza->Codigo_Contrato}}</td>
					<td>{{$poliza->Nombre_Contrato}}</td>
					<td>{{$poliza->Estado}}</td>
					<td>{{$poliza->Renovacion}}</td>
					<td>{{$poliza->Vigecia_Hasta}}</td>
					<td>{{$poliza->Dias_Restantes}}</td>
					
				</tr>
				@endforeach
				</tr>
			</tbody>
			<tfoot>
				<tr class="table-primary">
					<td>Opciones</td>
					
					<td>Codigo_Poliza</td>
					<td>Valor_Poliza</td>
					<td>Tipo_Poliza</td>
					<td>Vigencia_Desde</td>
					<td>Plazo</td>
					<td>Aseguradora</td>
					<td>Afianzado</td>
					<td>Codigo_Contrato</td>
					<td>Nombre_Contrato</td>
					<td>Estado</td>
					<td>Renovacion</td>
					<td>Vigecia_Hasta</td>
					<td>Dias_Restantes</td>
					
					
				</tr>

			</tfoot>
		</table>
		{{ $polizas -> appends(['searchText' => $query]) -> links() }}
@endsection @section( "piepagina" ) @endsection