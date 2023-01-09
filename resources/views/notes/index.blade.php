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
        <div class="py-3 bg-light">
            <div class="container p-3">
                <div class="row mb-3">
                    <div class="col-12 col-md-4">
                        <h1>Bloc de notas</h1>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="input-group">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Buscador</span>
                            <input type="text" id="search" class="form-control">
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="d-flex justify-content-end align-items-center">
                            <button class="btn btn-primary btn-sm px-4 js-crear" data-url="/notes/create">Crear</button>
                        </div>
                    </div>
                </div>
                <div id="notes_div" class="row g-3">
                    <x-notes :notes="$notes"/>
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
    function getNotes(pagina) {
        $.ajax({
            type: 'GET',
            url: baseUrl + "/api/notes/getNotes/" + pagina,
            success: function(data) {
                $('#notes_div').empty();
                $('#notes_div').append(data);
            }
        });
    }
</script>

@vite(['resources/js/app.js'])

</html>