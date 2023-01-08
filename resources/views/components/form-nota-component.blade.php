<div>
    <form id="notaForm" method="POST" action="{{route('notas.store')}}">
        @csrf

        <input type="hidden" name="nota_id" value="{{$nota->id}}" />

        <div class="mb-3">
            <label for="titulo" class="form-label">Titulo</label>
            <input type="text" class="form-control" id="titulo" name="titulo" value="{{$nota->titulo}}" required>
            
            <div id="tituloFeedback" class="invalid-feedback" style="display:none">
                {{ $errors->first("titulo") }}
            </div>
        </div>
        <div class="mb-3">
            <label for="cuerpo" class="form-label">Cuerpo</label>
            <textarea class="form-control" rows="10" id="cuerpo" name="cuerpo" required>{{ $nota->cuerpo }}</textarea>
            
            <div id="cuerpoFeedback" class="invalid-feedback" style="display:none">
                {{ $errors->first("cuerpo") }}
            </div>
        </div>

        <div class="pt-4 text-center">
            <button type="submit" class="btn btn-primary me-sm-3 me-1">Guardar</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Cerrar</button>
        </div>
    </form>
</div>

<script>
    $('#notaForm').on('submit', function(e) {
        e.preventDefault();

        let url = $(this).attr('action');

        $.ajax({
            type: 'POST',
            url: url,
            dataType: "json",
            data: $(this).serializeArray(),
            success: function success(data) {
                let pagina = 1;
                if($('.pagination > .active').length > 0) {
                    pagina = $('.pagination > .active')[0].innerText;
                }
                getNotas(pagina);
                $('#modal').modal('hide');
            },
            error: function error(data) {
                console.log(data);
            }
        });
    });
</script>