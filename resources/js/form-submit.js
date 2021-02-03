const validate = require('jquery-validation');

if ($('form#create-update-post').length)
{

    var formPostMessages = {
        title: {
            required: "Per favore, inserire il titolo del post",
            maxlength: "Titolo troppo lungo"
        },
        author: {
            required: "Per favore, inserire l'autore del post",
            maxlength: "Nome autore troppo lungo"
        },
        content: "Per favore, inserire il contenuto del post",
        category_id: "Id della categoria selezionata non valido"
    };

    var allCategories = [];
    $('select[name="category_id"] option').each(function() {
        allCategories.push($(this).val());
    });

    $.validator.addMethod('categoryExists', function(value) {
        return allCategories.includes(value);
    });

    var allTags = [];
    $('input[name^="tags"]').each(function() {
        var tagId = $(this).val();
        allTags.push(tagId);
        formPostMessages[`tags[${tagId}]`] = "L'id di questo tag non è valido";
    });

    $('form#create-update-post').validate({
        rules: {
            title: {
                required: true,
                maxlength: 255,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            author: {
                required: true,
                maxlength: 50,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            content: {
                required: true,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            category_id: {
                categoryExists: true
            }
        },
        messages: formPostMessages,
        errorPlacement: function(error, element) {
            if (element.attr("name").includes("tags")) {
                error.insertAfter($(element).parent());
            } else {
                error.insertAfter($(element));
            }
        }
    });

    $.validator.addMethod('tagsExist', function(value) {
        return allTags.includes(value) || value == undefined;
    });

    $('input[name^="tags"]').each(function() {
        $(this).rules('add', {
            tagsExist: true
        });
    });

}
else if ($('form#create-update-category'))
{

    $('form#create-update-category').validate({
        rules: {
            name: {
                required: true,
                maxlength: 255,
                normalizer: function(value) {
                    return $.trim(value);
                }
            }
        },
        messages: {
            name: {
                required: "Per favore, inserire un nome categoria",
                maxlength: "Nome categoria troppo lungo"
            }
        }
    });

}
