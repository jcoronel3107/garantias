<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type">
<meta charset="utf-8">
<meta name="Content-Type">
<meta content="text/html">
</head>
<body>
<p align="center"><a href="http://www.bomberos.gob.ec"><img src="http://www.bomberos.gob.ec/imgs/firmas/logofirma.png" alt="Logo" width="90" height="80" hspace="5" align="middle"/></a></p><br />
<h3 align="center">RECORDATORIO EMITIDO POR SISTEMA CONTROL DE GARANTIAS</h3>
<h4 align="center">BENEMERITO CUERPO DE BOMBEROS VOLUNTARIOS DE CUENCA</h4>
<p>Estimado</p>
<p><strong>{{$poliza->contrato->administrador}}</strong></p>
<p>Administrador de Contrato</p>
<br>
<p>Este correo es un recordatorio para la póliza que Usted administra para el Benemérito Cuerpo de Bomberos Voluntarios de Cuenca:</p>
    <ul>
    <p><h3><strong>Poliza Nro: </strong> </h3></p>
    <div style="padding-left:50px;"><li>{{$poliza->id}}</li></div>
    <p><h3><strong>TIPO_POLIZA: </strong></h3></p>
    <div style="padding-left:50px;"><li>{{$poliza->Tipo_Poliza}}</li></div>
    <p><h3><strong>Nombre Contrato:</strong></h3> </p>
    <div style="padding-left:50px;"><li>{{$poliza->contrato->Nombre_Contrato}}</li></div>
    <p><h3><strong>Nombre_afianzado:</strong></h3></p>
    <div style="padding-left:50px;"><li>{{$poliza->contrato->afianzado->afianzado}}</li></div>
    <p><h3><strong>Administrador:</strong> </h3>
    <div style="padding-left:50px;"><li>{{$poliza->contrato->administrador}}</li></div>
    <p><strong>Aseguradora:</strong></p>
    <div style="padding-left:50px;"><li>{{$poliza->aseguradora->Razon_Social}}</li></div>
    <p><strong>Valor_Poliza:</strong> </p>
    <div style="padding-left:50px;"><li>USD $.{{$poliza->Valor_Poliza}}</li><br ></div>
    <p><strong>Vigencia_Desde:</strong> </p>
    <div style="padding-left:50px;"><li>{{$poliza->Vigencia_Desde}}</li></div>
    <p><strong>Plazo:</strong></p>
    <div style="padding-left:50px;"><li>{{$poliza->Plazo}}  dia(s)</li></div>
    <p><strong>Dias_Resta:</strong> </p>
    <div style="padding-left:50px;"><li>{{$poliza->Dias_Restantes}} dia(s)</li><br></div>
    <br>
    <p><strong>Saludos</strong></p>
    <p>Sistema de Gestion Garantias B.C.B.V.C</p>

<p style="font:Arial, Helvetica, sans-serif; font-size:10px">
<em>Este correo es informativo, favor no responder a esta direcci�n de correo, ya que no se encuentra habilitada para recibir mensajes.</em></p>
</body>
</html>