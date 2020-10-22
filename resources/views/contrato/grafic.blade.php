	@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )

	<main role="main" class="flex-shrink-0">
		<div class="row py-5"></div>
  		<div class="py-2" id="container">
	</main>


<script src="{{asset('js/highcharts.src.js')}}"></script>
<script src="{{asset('js/exporting.js')}}"></script>
<script src="{{asset('js/offline-exporting.js')}}"></script>
<script type="text/javascript">
	var contratos = <?php echo json_encode($contratos) ?>;
	Highcharts.chart('container',{
		title:{
			text: 'Contratos Registrados'
		},
		subtitle:{
					text: 'Grafica'
		},
		xAxis:{
			categories:['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic',]
		},
		yAxis:{
			title:{
				text: 'Contratos'
			}
		},
		legend:{
			layout:'vertical',
			align: 'right',
			verticalAling:'middle'
		},
		plotOptions:{
			series:{
				allowPointSelect:true
			}
		},
		series:[{
				name:'Nuevos Registros',
				data: contratos
		}],
		responsive:{
			rules:[{
					condition: {
						maxWidth:500
					},
					chartOptions:{
						legend:{
							layout: 'horizontal',
							aling:'center',
							verticalAling:'bottom'
						}
					}
			}]
		}
	});
</script>
@endsection
@section( "piepagina" ) @endsection