<div>
    <form id="noteForm" method="POST" action="{{route('notes.store')}}">
        @csrf

        <input type="hidden" name="note_id" value="{{$note->id}}" />

        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input type="text" class="form-control" id="title" name="title" value="{{$note->title}}" required>
            
            <div id="titleFeedback" class="invalid-feedback" style="display:none">
                {{ $errors->first("title") }}
            </div>
        </div>
        <div class="mb-3">
            <label for="body" class="form-label">Cuerpo</label>
            <textarea class="form-control" rows="10" id="body" name="body" required>{{ $note->body }}</textarea>
            
            <div id="bodyFeedback" class="invalid-feedback" style="display:none">
                {{ $errors->first("body") }}
            </div>
        </div>

        <div class="pt-4 text-center">
            <button type="submit" class="btn btn-primary me-sm-3 me-1">Guardar</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Cerrar</button>
        </div>
    </form>
</div>

<script>
    $('#noteForm').on('submit', function(e) {
        e.preventDefault();

        let url = $(this).attr('action');

        $.ajax({
            type: 'POST',
            url: url,
            dataType: "json",
            data: $(this).serializeArray(),
            success: function success(data) {
                if($('#search').val()) {
                    $('#search').keyup();
                } else {
                    let pagina = 1;
                    if($('.pagination > .active').length > 0) {
                        pagina = $('.pagination > .active')[0].innerText;
                    }
                    getNotes(pagina);
                }
                $('#modal').modal('hide');
            },
            error: function error(data) {
                console.log(data);
            }
        });
    });
</script>