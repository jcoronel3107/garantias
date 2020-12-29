@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )
        @can('send notification')
            <h1 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Notificaciones de Polizas</h1>
             
            <form class="form" action="/polizas/notificacion" method="post" enctype="multipart/form-data">
             	@csrf
                <div class="form-row">
                    <div class="form-group input-group  col-md-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Tipo_Poliza</span>
                        </div>
                        <input type="text" maxlength="50" name="Codigo_Poliza" placeholder="Digite el Codigo de la poliza" class="form-control" value="{{old('Codigo_Poliza',$poliza->Tipo_Poliza)}}">
                    </div>  
                
                    <div class="form-group input-group  col-md-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Codigo_Poliza</span>
                        </div>
                        <input type="text" maxlength="50" name="Codigo_Poliza" placeholder="Digite el Codigo de la poliza" class="form-control" value="{{old('Codigo_Poliza',$poliza->Codigo_Poliza)}}">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group input-group  col-md-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Plazo</span>
                        </div>
                        <input type="number" name="Plazo" placeholder="Digite el plazo de la poliza en dias" class="form-control" value="{{old('Plazo',$poliza->Plazo)}}">
                    </div>
                    <div class="form-group input-group  col-md-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Aseguradora</span>
                        </div>
                        <input type="number" required="" name="Plazo" placeholder="Digite el plazo de la poliza en dias" class="form-control" value="{{old('Plazo',$poliza->aseguradora->id)}}">
                        
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group input-group  col-md-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Valor_Poliza</span>
                        </div>
                        <input type="number" required="" step="0.01" name="Valor_Poliza" placeholder="Digite el Valor de la Poliza" class="form-control" value="{{old('Valor_Poliza',$poliza->Valor_Poliza)}}">
                    </div>
                    <div class="form-group input-group  col-md-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Vigencia_Desde</span>
                        </div>
                        <input type="input" required="" name="Vigencia_Desde" class="form-control" placeholder="Digite Fecha de emision Poliza" value="{{old('Vigencia_Desde',$poliza->Vigencia_Desde)}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group input-group col-md-12">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Contrato para Asociar</span>
                        </div>
                        <input type="input" required="" name="Vigencia_Desde" class="form-control" placeholder="Digite Fecha de emision Poliza" value="{{old('Vigencia_Desde',$poliza->contrato->id)}}">
                        
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group input-group col-md-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Estado</span>
                        </div>

                        <select data-toggle="tooltip" data-placement="right" title="Activa=1 Desactiva=0" class="form-control" required id="Estado" name="Estado" onchange="showContent()">
                            <option value="{{$poliza->Estado}}" >Activo</option>
                            <option value="1">1</option>
                            <option value="0">0</option>

                        </select>
                    </div>
                    <div class="form-group input-group col-md-3">
                        <div class="input-group-prepend">
                                <span class="input-group-text">Renovacion</span>
                        </div>
                        <select class="form-control" required name="Renovacion">
                            <option selected>{{old('Renovacion',$poliza->Renovacion)}}</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </div>
                    <div id="cierre" style="display: none;" class="form-group input-group col-md-4">
                        <div  class="input-group-prepend">
                                <span class="input-group-text">Fecha Cierre</span>
                        </div>
                        <input  type="date"  name="Fecha_Cierre" class="form-control" placeholder="Digite Fecha de Cierre Poliza" value="{{old('Fecha_Cierre',$poliza->Fecha_Cierre)}}">
                    </div>
                </div>

            </form>
            @push('scripts')
                <script  >
                    function showContent() {
                        element = document.getElementById("cierre");
                        getSelectValue  = document.getElementById("Estado").value;
                        if (getSelectValue == "0") {
                            element.style.display='flex';
                        }
                        else {
                            element.style.display='none';
                        }
                    }
                </script>
            @endpush('scripts')
        @else
                <p>Lo sentimos, No Tienes Permisos de Consulta.</p>
        @endcan
    @endsection

	@section( "piepagina" )

	@endsection