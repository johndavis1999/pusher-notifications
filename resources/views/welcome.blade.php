<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <!-- Incluye los enlaces a las bibliotecas de Toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
</head>
<body>

    <!-- Contenido de tu vista -->

    <!-- Incluye el script de Toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <!-- Script para manejar las notificaciones -->
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        Pusher.logToConsole = true;
        var pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
            cluster: '{{ env("PUSHER_APP_CLUSTER") }}',
        });
        var channel = pusher.subscribe('notifications');
        channel.bind('new-notification', function(data) {
            if (data && data.message) {
                // Verifica si las notificaciones están permitidas en el navegador
                if (Notification.permission === "granted") {
                    // Crea la notificación
                    var notification = new Notification(data.titulo, {
                        body: data.message,
                        icon: '{{ asset('logo.png') }}' // Opcional: Añade un icono
                    });
                    // Maneja el evento onclick
                    notification.onclick = function() {
                        console.log('Notification clicked, URL:', data.url);
                        window.open(data.url, '_blank');
                    };
                } else if (Notification.permission !== "denied") {
                    // Pide permiso para mostrar notificaciones si aún no se ha solicitado
                    Notification.requestPermission().then(function(permission) {
                        if (permission === "granted") {
                            // Crea la notificación si se otorga el permiso
                            var notification = new Notification(data.titulo, {
                                body: data.message,
                                icon: '{{ asset('logo.png') }}' // Opcional: Añade un icono
                            });
                            // Maneja el evento onclick
                            notification.onclick = function() {
                                console.log('Notification clicked, URL:', data.url);
                                window.open(data.url, '_blank');
                            };
                        }
                    });
                }
            } else {
                console.error('Invalid data structure received:', data);
            }
        });
    </script>
    
</body>
</html>
