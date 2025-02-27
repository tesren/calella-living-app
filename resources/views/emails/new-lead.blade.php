<!DOCTYPE html>

<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Mensaje del sitio web de Calella Living</title>
    </head>

    <body>
        <p>
            Nuevo lead desde el sitio web de Calella Living
        </p>
            
        <p>Nombre: <strong>{{$msg->name}}</strong></p>
        <p>Correo: <strong>{{$msg->email}}</strong></p>
        <p>Teléfono: <strong>{{$msg->phone ?? 'Sin especificar'}}</strong></p>
    
        <p>Contenido: <strong>{{$msg->content ?? 'Sin Contenido'}}</strong></p> <br>
    
        <p>Enviado el: {{$msg->created_at}}</p>
        <p>Desde: {{$msg->url}}</p>
    
        
        <p>Este mensaje fue enviado desde un formulario de contacto en el sitio web de Calella Living</p>
       
    
    </body>

</html>