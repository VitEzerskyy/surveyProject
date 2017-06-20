
var $addChoiceLink = $('<a href="#" class="add_choice_link">Add a choice</a>');
var $newLinkLi = $('<li></li>').append($addChoiceLink);

jQuery(document).ready(function() {

    var $existFormLi = $('ul.choices li').append('<a href="#" class="remove-choice">x</a>');

    var $collectionHolder = $('ul.choices');
    $collectionHolder.append($newLinkLi);

    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addChoiceLink.on('click', function(e) {

        e.preventDefault();
        addChoiceForm($collectionHolder, $newLinkLi);
    });

    $('.remove-choice').click(function(e) {
        e.preventDefault();

        $(this).parent().remove();
        return false;
    });

});

function addChoiceForm($collectionHolder, $newLinkLi) {

    var prototype = $collectionHolder.data('prototype');
    var index = $collectionHolder.data('index');
    var newForm = prototype.replace(/__name__/g, index);

    $collectionHolder.data('index', index + 1);

    var $newFormLi = $('<li></li>').append(newForm);
    $newFormLi.append('<a href="#" class="remove-choice">x</a>');

    $newLinkLi.before($newFormLi);


    $('.remove-choice').click(function(e) {
        e.preventDefault();

        $(this).parent().remove();
        return false;
    });
}