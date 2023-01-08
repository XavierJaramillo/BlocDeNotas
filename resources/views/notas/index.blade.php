<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Bloc de notas</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
</head>

<body>
    <main>
        <div class="album py-5 bg-light">
            <div class="container p-3">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <h1>Bloc de notas</h1>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="input-group">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Buscador</span>
                            <input type="text" id="search" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="d-flex justify-content-end align-items-center">
                            <button class="btn btn-primary btn-sm px-4 js-crear" data-url="/notas/create">Crear</button>
                        </div>
                    </div>
                </div>
                <div id="notas_div" class="row g-3">
                    <x-notas :notas="$notas"/>
                </div>
            </div>
        </div>
    </main>

    <x-modal-componente/>
</body>

<script>
    if (typeof baseUrl === 'undefined') {
        baseUrl = "{{ url('/') }}";
    }
</script>

<script>
    function getNotas(pagina) {
        $.ajax({
            type: 'GET',
            url: baseUrl + "/api/notas/getNotas/" + pagina,
            success: function(data) {
                $('#notas_div').empty();
                $('#notas_div').append(data);
            }
        });
    }
</script>

@vite(['resources/js/app.js'])

</html>