$(function() {
    console.log("loaded");

    var $collectionHolder;

    // setup an "add a translation" link
    var $addTranslationLink = $('<a href="#" class="add_Translation_link">Add a translation</a>');
    var $newLinkDiv = $('<div></div>').append($addTranslationLink);

    // Get the td that holds the collection of translations
    $collectionHolder = $('td.translations');

    // add the "add a translation" anchor and div to the translations td
    $collectionHolder.append($newLinkDiv);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addTranslationLink.on('click', function(e) {
        // prevent the link from creating a "   #" on the URL
        e.preventDefault();

        // add a new tag form (see next code block)
        addTagForm($collectionHolder, $newLinkDiv);
    });



    function addTagForm($collectionHolder, $newLinkDiv) {
        // Get the data-prototype explained earlier
        var prototype = $collectionHolder.data('prototype');

        // get the new index
        var index = $collectionHolder.data('index');

        // Replace '__name__' in the prototype's HTML to
        // instead be a number based on how many items we have
        var newForm = prototype.replace(/__name__/g, index);

        // increase the index with one for the next item
        $collectionHolder.data('index', index + 1);

        // Display the form in the page in an li, before the "Add a tag" link li
        var $newFormDiv = $('<div></div>').append(newForm);
        $newLinkDiv.before($newFormDiv);
    }

});
