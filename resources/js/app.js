import './bootstrap';

import '../sass/app.scss'

$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#search').on('keyup', function() {
        let search = $(this).val();

        $.ajax({
            type: 'POST',
            url: baseUrl + "/api/notas/search",
            data: {
                "where": search
            },
            success: function(data) {
                $('#notas_div').empty();
                $('#notas_div').append(data);
            }
        });
    })

    $(document).on('click', 'a', function(event) {
        event.preventDefault();

        getNotas($(this).attr('href').split('page=')[1]);
    });

    $('.js-crear').on('click', function(event) {
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
});