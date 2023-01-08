@if($notas->total() == 0)
  <div class="col-0"></div>
  <div class="col-12 col-md-">
    <div class="card shadow-sm mb-3 bg-body-tertiary rounded">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
          <h5 class="card-title font-weight-bold text-uppercase m-0">
            Actualmente no hay notas.
          </h5>
        </div>
      </div>
    </div>
  </div>
  <div class="col-0"></div>
@endif

@foreach ($notas as $nota)
  <div class="col-12 col-md-6 cardsNotas">
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
                      {{$nota->created_at->format('d-m-Y');}} 
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
                <li><button class="dropdown-item js-edit" data-url="/notas/{{$nota->id}}/edit" type="button">Editar</button></li>
                <li><button class="dropdown-item js-delete" data-url="/notas/{{$nota->id}}" type="button">Eliminar</button></li>
              </ul>
            </div>
          </div>
          <h5 class="card-title font-weight-bold text-uppercase">
            {{$nota->titulo}} 
          </h5>
          <p class="card-text">{{$nota->cuerpo_format}}</p>
        </div>
      </div>
  </div>
@endforeach

<div class="d-flex justify-content-center pt-2">
  {{ $notas->links() }}
</div>

<script>
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
              let pagina = 1;
              if($('.pagination > .active').length > 0) {
                  pagina = $('.pagination > .active')[0].innerText;
              }

              if($('.cardsNotas').length == 1) {
                pagina = pagina - 1;
              }

              getNotas(pagina);
            }
        });
    });
</script>