const Swal = require('sweetalert2');

const token = $("meta[name='csrf-token']").attr("content");

// whenever the delete button is clicked
$('a.delete-item').click(function(e){
    e.preventDefault();
    // we get the selected item (i.e. the item we want to delete), its id and its type
    var selectedItem = $(this).parent('td').parent('tr');
    var itemId = selectedItem.attr("id");
    var itemType = selectedItem.data('item-type');

    // based on the type of the item we want to delete, we define all the remaining variables we need
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

    // we display a window which requires the user to confirm or deny the deletion of the selected item
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
            // if the deletion is confirmed, we make an AJAX request, in order to delete the item from the database
            $.ajax({
                url: `/admin/${uri}/${itemId}`,
                type: 'POST',
                data: {
                    "_token": token,
                    "_method": "DELETE"
                },
                success: function() {
                    // once the item has been removed from the database, we remove it from the view
                    selectedItem.remove();

                    if (!$.trim($('table tbody').html())) {
                        // if the displayed table containing the items is empty,
                        // we remove from the view the table
                        itemsContainer.remove();
                        // and instead of the table we display a message which warns the user that no more items are available in the database
                        $('.list-title').text(noItemsMessage);
                    }

                    // finally, we display a window that confirms the item's deletion
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
