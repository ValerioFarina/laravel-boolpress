const Swal = require('sweetalert2');

const token = $("meta[name='csrf-token']").attr("content");

$('a.delete-item').click(function(e){
    e.preventDefault();
    var selectedItem = $(this).parent('td').parent('tr');
    var itemId = selectedItem.attr("id");
    var itemType = selectedItem.data('item-type');

    switch (itemType) {
        case 'post':
        case 'post-category':
            var uri = 'posts';
            var question = `Sei sicuro di voler eliminare il post #${itemId} ?`;
            var confirmationMessage = `Il post #${itemId} è stato eliminato.`;
            var itemsContainer = $('.posts-list');

            switch (itemType) {
                case 'post':
                    var noItemsMessage = 'Nessun post presente';
                    break;

                case 'post-category':
                    var currentCategory = $('.list-title').data('category-name');
                    var noItemsMessage = "Nessun post presente nella categoria '" + currentCategory + "'";
                    break;
            }
            break;

        case 'category':
            var uri = 'categories';
            var question = `Sei sicuro di voler eliminare la categoria #${itemId} ?`;
            var confirmationMessage = `La categoria #${itemId} è stata eliminata.`;
            var itemsContainer = $('.categories-list');
            var noItemsMessage = 'Nessuna categoria presente';
            break;
    }

    Swal.fire({
        title: question,
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
                url: `/admin/${uri}/${itemId}`,
                type: 'POST',
                data: {
                    "_token": token,
                    "_method": "DELETE"
                },
                success: function() {
                    selectedItem.remove();

                    if (!$.trim($('table tbody').html())) {
                        itemsContainer.remove();
                        $('.list-title').text(noItemsMessage);
                    }

                    Swal.fire(
                        'Eliminato!',
                        confirmationMessage,
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
