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

        let page = 1;
        if ($('.pagination > .active').length > 0) {
            page = $('.pagination > .active')[0].innerText;
        }

        if (search != null || search.trim() !== '') {
            $.ajax({
                type: 'POST',
                url: baseUrl + "/api/notes/search",
                data: {
                    "where": search,
                    "page": page
                },
                success: function(data) {
                    $('#notes_div').empty();
                    $('#notes_div').append(data);
                }
            });
        }
    })

    $(document).on('click', 'a', function(event) {
        event.preventDefault();

        getNotes($(this).attr('href').split('page=')[1]);
    });

    $('.js-crear').on('click', function(event) {
        let url = $(this).data('url');

        $.ajax({
            type: 'GET',
            url: baseUrl + url,
            success: function(data) {
                $('#modal-body').empty();
                $('#modal-title').text("Crear nota");
                $('#modal-body').append(data);
                $('#modal').modal('show');
            }
        });
    });
});