	@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )
		@can('view estadistica')

	  		<div class="py-2 col-lg-6 col-md-6 col-sm-12 " id="Polizas_Activas"></div>
			<div class="py-2 col-lg-6 col-md-6 col-sm-12 " id="Polizas_Canceladas"></div>
		@else
  			<p>Lo sentimos, No Tienes Permisos de Consulta.</p>
		@endcan
			<script src="{{asset('js/highcharts.src.js')}}"></script>
			<script src="{{asset('js/exporting.js')}}"></script>
			<script src="{{asset('js/offline-exporting.js')}}"></script>
			<script type="text/javascript">
				var polizasvigentes = <?php echo json_encode($polizasvigentes) ?>;
				Highcharts.chart('Polizas_Activas',{
					title:{
						text: 'Polizas Activas'
					},
					subtitle:{
								text: 'Grafica'
					},
					xAxis:{
						/*categories:['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic',]*/
						categories:['Ago','Sep','Oct','Nov','Dic',]
					},
					yAxis:{
						title:{
							text: 'Polizas Activas'
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
							data: polizasvigentes
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
			<script type="text/javascript">
				var polizascanceladas = <?php echo json_encode($polizascanceladas) ?>;
				Highcharts.chart('Polizas_Canceladas',{
					title:{
						text: 'Polizas_Canceladas'
					},
					subtitle:{
								text: 'Grafica'
					},
					xAxis:{
						/*categories:['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic',]*/
						categories:['Ago','Sep','Oct','Nov','Dic',]
					},
					yAxis:{
						title:{
							text: 'Polizas_Canceladas'
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
							data: polizascanceladas
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