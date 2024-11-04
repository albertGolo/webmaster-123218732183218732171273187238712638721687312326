// jquery is gay and retarded

const $search = $('#global-search-bar');
const $results = $('#global-search-results');

let searchDelay;

$search.keyup(function() {
    const search = $(this).val();

    if (search.length == 0) {
        $results.hide();
        $results.html('');
        return;
    }

    clearTimeout(searchDelay);

    searchDelay = setTimeout(() => {
        $.get('/api/search/all', { search }).done(function(data) {
            $results.html('');
            $results.show();

            if (typeof data.error !== 'undefined' && data.error) {
                $results.html(`<div class="navbar-search-error">${data.error}</div>`);
                return;
            }

            $results.append('<li class="dropdown-title">Quick Results</li>');

            $.each(data, function() {
                $results.append(`
                <li class="dropdown-item">
                    <a href="${this.url}" class="dropdown-link">
                        <div class="flex-container align-middle align-justify">
                            <div class="flex-container align-middle gap-2">
                                <img src="${this.image}" class="headshot flex-child-grow" width="38">
                                <div>${this.name}</div>
                            </div>
                            <i class="fas fa-chevron-right text-muted px-1"></i>
                        </div>
                    </a>
                </li>`);
            });
        }).fail(function () {
            $results.html('<div class="navbar-search-error">No results found.</div>');
        });
    }, 500);
});