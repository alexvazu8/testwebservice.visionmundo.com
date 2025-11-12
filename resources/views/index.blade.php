<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vision Mundo - Descubre lo Mejor</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Estilos personalizados */
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Estilos para el encabezado */
        header {
            background-color: #cccccc;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        /* Estilos para la sombra del título */
        .title-shadow {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        /* Estilos para la sección principal */
        main {
            padding: 20px 0;
        }

        /* Estilos para el texto de bienvenida */
        h1 {
            color: #007bff;
            font-size: 3rem;
        }

        p {
            color: #555;
            font-size: 1.2rem;
            line-height: 1.6;
        }

        /* Estilos para el enlace a la documentación de la API */
        .api-doc-link {
            color: #007bff;
            font-size: 1.2rem;
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .api-doc-link:hover {
            color: #0056b3;
        }

        /* Estilos para los formularios */
        form {
            margin-top: 20px;
        }

        /* Estilos para el footer */
        footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 20px 0;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <img src="{{ asset('/logo-vm.png') }}" alt="Logo Vision Mundo">
            <h1 class="display-4 title-shadow">Bienvenido a Vision Mundo</h1>
        </div>
    </header>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <p class="lead">Somos una operadora de turismo boliviana con sedes en Santa Cruz y Cochabamba. Nuestro objetivo es utilizar la tecnología para brindar experiencias inolvidables. Hemos digitalizado las tours y la rica cultura del Mundo. Vision Mundo brinda las mejores herramientas para reservar, hoteles, traslados y tours.</p>
                    <a href="{{ route('l5-swagger.default.api') }}" class="api-doc-link">¿Quieres Integrarte vía API REST? Consulta nuestra documentación.</a>
                    <form>
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" placeholder="Ingrese su nombre">
                        </div>
                        <div class="form-group">
                            <label for="email">Correo electrónico:</label>
                            <input type="email" class="form-control" id="email" placeholder="Ingrese su correo electrónico">
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <div class="container">
            <p class="mb-0">&copy; {{ date('Y') }} Vision Mundo. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>
