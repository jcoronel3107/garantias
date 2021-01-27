@extends( "layouts.plantilla" )

	@section( "cabeza" )


	@endsection

	@section( "cuerpo" )
        @can('send notification')
            <h1 class="mt-5 shadow p-3 mb-5 bg-white rounded text-danger">Notificaciones de Polizas</h1>
             
            <form class="form" action="/poliza/notificacion" method="post" enctype="multipart/form-data">
             	@csrf
                <div class="form-row">
                    <div class="form-group input-group  col-md-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Tipo_Poliza</span>
                        </div>
                        <input type="text" name="Tipo_Poliza" readonly="true" class="form-control" value="{{old('Tipo_Poliza',$poliza->Tipo_Poliza)}}">
                    </div>  
                
                    <div class="form-group input-group  col-md-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Codigo_Poliza</span>
                        </div>
                        <input type="text" maxlength="50" name="Codigo_Poliza" class="form-control" readonly="true" value="{{old('Codigo_Poliza',$poliza->Codigo_Poliza)}}">
                        <input type="hidden" name="id_Poliza" class="form-control" readonly="true" value="{{old('id_Poliza',$poliza->id)}}">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group input-group  col-md-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Plazo</span>
                        </div>
                        <input type="text" name="Plazo" readonly="true" class="form-control" value="{{old('Plazo',$poliza->Plazo)}} Días">
                    </div>
                    <div class="form-group input-group  col-md-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Aseguradora</span>
                        </div>
                        <input type="text" required="" name="Plazo" readonly="true" class="form-control" value="{{old('Plazo',$poliza->aseguradora->Razon_Social)}}">
                        
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group input-group  col-md-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Valor_Poliza</span>
                        </div>
                        <input type="number" required="" step="0.01" name="Valor_Poliza" readonly="true" class="form-control" value="{{old('Valor_Poliza',$poliza->Valor_Poliza)}}">
                    </div>
                    <div class="form-group input-group  col-md-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Vigencia_Desde</span>
                        </div>
                        <input type="text" required="" name="Vigencia_Desde" class="form-control" readonly="true" value="{{old('Vigencia_Desde',$poliza->Vigencia_Desde)}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group input-group col-md-12">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Contrato para Asociar</span>
                        </div>
                        <textarea name="Vigencia_Desde" class="form-control" readonly="true">{{old('Vigencia_Desde',$poliza->contrato->Nombre_Contrato )}}</textarea>
                        
                        
                    </div>
                    <div class="form-group input-group col-md-12">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Administrador</span>
                        </div>
                        <input type="text" required="" name="Vigencia_Desde" class="form-control" readonly="true" value="{{old('Vigencia_Desde',$poliza->contrato->administrador )}}">
                        
                    </div>
                    <div class="form-group input-group col-md-12">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Email Administrador</span>
                        </div>
                        <input type="text" id="email" name="email" class="form-control" readonly="true" value="{{old('Vigencia_Desde',$poliza->contrato->mail_administrador )}}">
                        
                    </div>
                    <div class="form-group input-group col-md-12">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Afianzado</span>
                        </div>
                        <input type="text" id="afianzado" name="afianzado" class="form-control" readonly="true" value="{{old('afianzado',$poliza->contrato->afianzado->afianzado )}}">
                        
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group input-group col-md-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Estado</span>
                        </div>

                        <select data-toggle="tooltip" data-placement="right" title="Activa=1 Desactiva=0" class="form-control" readonly="true" id="Estado" name="Estado">
                            <option value="{{$poliza->Estado}}" >Activo</option>
                        </select>
                    </div>
                    <div class="form-group input-group col-md-3">
                        <div class="input-group-prepend">
                                <span class="input-group-text">Renovacion</span>
                        </div>
                        <select class="form-control" readonly="true" name="Renovacion">
                            <option selected>{{old('Renovacion',$poliza->Renovacion)}}</option>
                        </select>
                    </div>
                    
                    
                </div>
                 <div class="form-row">
                   <div class="form-group">
                    <button type="submit" name="Enviar" value="Enviar" class="btn btn-success">Notificar</button>
                    <a class="btn btn btn-primary" role="button"
                        href="{{ route('poliza.index')}}">Cancelar
                    </a>
                    
                </div> {{-- Div Botones --}} 
                </div>

            </form>
            @push('scripts')
                <script  >
                    
                </script>
            @endpush('scripts')
        @else
                <p>Lo sentimos, No Tienes Permisos de Consulta.</p>
        @endcan
    @endsection

	@section( "piepagina" )

	@endsection