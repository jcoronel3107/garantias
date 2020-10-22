@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )
    <h1 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Notificaciones de Polizas</h1>
         <form class="form" action="/polizas/notificacion" method="post" enctype="multipart/form-data">
         	@csrf
            <div class="form-group input-group  col-md-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Poliza</span>
                        </div>
                        <select class="form-control selectpicker" name="Aseguradora" data-live-search="true" required="">
                            <option selected>{{old('Aseguradora',"Seleccione...")}}</option>

                        </select>
                    </div>

         </form>
    @endsection

	@section( "piepagina" )

	@endsection