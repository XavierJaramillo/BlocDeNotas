@if($notes->total() == 0)
  <div class="col-12">
    <div class="card shadow-sm mb-3 bg-body-tertiary rounded">
      <div class="card-body">
        <div class="d-flex justify-content-center align-items-center">
          <span class="card-title font-weight-bold text-uppercase m-0 fs-4">
             Sin resultados.
          </span>
        </div>
      </div>
    </div>
  </div>
@endif

@foreach ($notes as $note)
  <div class="col-12 col-md-6 cardsNotes">
      <div class="card p-3 shadow-sm mb-3 bg-body-tertiary rounded">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-4">
            {{-- 
              Usuario de ejemplo.
            --}}
            <div class="row">
              <div class="col-3 d-flex align-items-center">
                <i class="bi bi-person-circle text-success fs-2"></i> 
              </div>
              <div class="col-9">
                <div class="row">
                  <div class="col-12">
                    <span class="fs-6">Xavier</span>
                  </div>
                  <div class="col-12">
                    <span class="fs-6">
                      {{$note->created_at->format('d-m-Y');}} 
                    <span>
                  </div>
                </div>
              </div>
            </div>

            <div class="dropdown">
              <button class="btn btn-sm p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-three-dots-vertical"></i>
              </button>
              <ul class="dropdown-menu">
                <li><button class="dropdown-item js-edit" data-url="/notes/{{$note->id}}/edit" type="button">Editar</button></li>
                <li><button class="dropdown-item js-delete" data-url="/notes/{{$note->id}}" type="button">Eliminar</button></li>
              </ul>
            </div>
          </div>
          <h5 class="card-title font-weight-bold text-uppercase">
            {{$note->title}} 
          </h5>
          <p class="card-text">{{$note->body_format}}</p>
        </div>
      </div>
  </div>
@endforeach

<div class="d-flex justify-content-center pt-2">
  {{ $notes->links() }}
</div>

<script>
  function refreshNotes(changePage = false) {
    if ($('#search').val()) {
        $('#search').keyup();
    } else {
        let page = 1;
        if ($('.pagination > .active').length > 0) {
            page = $('.pagination > .active')[0].innerText;
        }

        if ($('.cardsNotes').length == 1 && changePage) {
            page = page - 1;
        }

        getNotes(page);
    }
  }

  $('.js-edit').on('click', function(event) {
    let url = $(this).data('url');

    $.ajax({
        type: 'GET',
        url: baseUrl + url,
        success: function(data) {
            $('#modal-body').empty();
            $('#modal-title').text("Editar nota");
            $('#modal-body').append(data);
            $('#modal').modal('show');
        }
    });
  });

  $('.js-delete').on('click', function(event) {
        let url = $(this).data('url');

        $.ajax({
            type: 'DELETE',
            url: baseUrl + url,
            success: function(data) {
              refreshNotes(true);
            }
        });
    });
</script>