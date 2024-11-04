var id;
var inventoryPublic = true;
var currentCategory = '';
var currentPage = 1;
var itemTypesWithPadding = [];
var itemTypePadding = '0px';

$(() => {
    const meta = 'meta[name="user-info"]';
    id = parseInt($(meta).attr('data-id'));
    inventoryPublic = parseInt($(meta).attr('data-inventory-public'));

    if (inventoryPublic)
        inventory('hats', 1);

    itemTypePadding = $('meta[name="item-type-padding-amount"]').attr('content');
    itemTypesWithPadding = JSON.parse($('meta[name="item-types-with-padding"]').attr('content'));

    $('[data-category]').click(function() {
        var oldCategory = currentCategory;

        $(`[data-category="${currentCategory}"]`).removeClass('active');
        $(this).addClass('active');

        currentCategory = $(this).attr('data-category');

        if (currentCategory != oldCategory)
            inventory(currentCategory, 1);
    });
});

function inventory(category, page)
{
    $.get('/api/users/inventory', { id, category, page }).done((data) => {
        $('#inventory').html('');
        currentCategory = category;
        currentPage = page;

        if (typeof data.error !== 'undefined')
            return $('#inventory').html(`<div class="col">${data.error}</div>`);

        $.each(data.items, function() {
            const padding = (itemTypesWithPadding.includes(this.type)) ? itemTypePadding : '0px';

            $('#inventory').append(`<div class="flex-container flex-wrap align-center gap-3"><div>
                    <a>
                        <div class="text-center min-w-0" style="width: 80px">
                            <img src="${this.thumbnail}">
                            <div class="text-xs fw-semibold text-truncate">
                                ${this.name}<br>
                            </div>
                        </div>
                    </a></div><div>
                   `);
        });

        if (data.total_pages > 1) {
            const previousDisabled = (data.current_page == 1) ? 'disabled' : '';
            const nextDisabled = (data.current_page == data.total_pages) ? 'disabled' : '';
            const previousPage = data.current_page - 1;
            const nextPage = data.current_page + 1;

            $('#inventory').append(`
            <div class="col-12 text-center">
                <button class="btn btn-sm btn-danger" onclick="inventory('${currentCategory}', ${previousPage})" ${previousDisabled}>&laquo;</button>
                <span class="text-muted ml-2 mr-2">${data.current_page} of ${data.total_pages}</span>
                <button class="btn btn-sm btn-success" onclick="inventory('${currentCategory}', ${nextPage})" ${nextDisabled}>&raquo;</button>
            </div>`);
        }
    }).fail(() => $('#inventory').html('<div class="col">Unable to get inventory.</div>'));
}
