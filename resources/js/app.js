require('./bootstrap');
const Swal = require('sweetalert2');

const token = $("meta[name='csrf-token']").attr("content");

$(document).ready(function() {
    $('a.delete-post').click(function(e){
        e.preventDefault();
        var selectedPost = $(this).parent('td').parent('tr');
        var postId = selectedPost.attr("id");

        var currentCategory = $('.category-posts-list-title').attr('id');

        Swal.fire({
            title: `Sei sicuro di voler eliminare il post #${postId} ?`,
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sì, elimina',
            cancelButtonText: 'No, non eliminare'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/admin/posts/${postId}`,
                    type: 'POST',
                    data: {
                        "_token": token,
                        "_method": "DELETE"
                    },
                    success: function() {
                        selectedPost.remove();

                        if (!$.trim($('.posts-list table tbody').html())) {
                            $('.posts-list').remove();

                            $('.posts-list-title').text('Nessun post presente');

                            $('.category-posts-list-title').text("Nessun post nella categoria '" + currentCategory + "'");
                        }

                        Swal.fire(
                            'Eliminato!',
                            `Il post #${postId} è stato eliminato.`,
                            'success'
                        );
                    },
                    error: function() {
                        console.log('errore');
                    }
                });
            }
        });
    });
});
