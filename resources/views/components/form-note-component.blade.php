<div>
    <form id="noteForm" method="POST" action="{{route('notes.store')}}">
        @csrf

        <input type="hidden" name="note_id" value="{{$note->id}}" />

        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input type="text" class="form-control" id="title" name="title" value="{{$note->title}}">
            
            <div id="titleFeedback" class="invalid-feedback">
            </div>
        </div>
        <div class="mb-3">
            <label for="body" class="form-label">Cuerpo</label>
            <textarea class="form-control" rows="10" id="body" name="body">{{ $note->body }}</textarea>
            
            <div id="bodyFeedback" class="invalid-feedback">
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

        $('.invalid-feedback').hide().text('');

        $.ajax({
            type: 'POST',
            url: url,
            dataType: "json",
            data: $(this).serializeArray(),
            success: function success(data) {
                refreshNotes();
                $('#modal').modal('hide');
            },
            error: function error(error) {
                let errorsJson = error.responseJSON.errors;

                Object.keys(errorsJson).forEach(function(key) {
                    let messages = errorsJson[key];

                    Object.keys(messages).forEach(function(keyM) {
                        let message = messages[keyM];
                        $('#'+key+'Feedback').show().text(message);
                    });
                });
            }
        });
    });
</script>