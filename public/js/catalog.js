/**
 * MIT License
 *
 * Copyright (c) 2021-2022 FoxxoSnoot
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

var currentCategory = '';
var currentSearch = '';

$(() => {
    $('#search').submit(function(event) {
        event.preventDefault();

        var oldSearch = currentSearch;
        currentSearch = $(this).find('input').val();

        if (currentSearch != oldSearch)
            search(currentCategory, 1, currentSearch);
    });

    $('[data-category]').click(function() {
        var oldCategory = currentCategory;

        $(`[data-category="${currentCategory}"]`).removeClass('active');
        $(this).addClass('active');

        currentCategory = $(this).attr('data-category');

        if (currentCategory != oldCategory)
            search(currentCategory, 1, currentSearch);
    });
    
    search('hats', 1, currentSearch);
});

function search(category, page, search)
{
    $.get('/api/catalog/search', { category, page, search }).done((data) => {
        $('#items').html('');
        currentCategory = category;
        currentSearch = search;

        if (typeof data.error !== 'undefined')
            return $('#items').html(`<div class="col">${data.error}</div>`);

        $.each(data.items, function() {
            var header = '';
            var price = `<div style="
                                            position: absolute;
                                            top: 10px;
                                            right: 10px;
                                        ">
                                        <div class="badge badge-success fw-semibold mb-1">
                                            <i class="fas fa-money-bill-1-wave" style="width: 18px"></i>${this.price}
                                        </div>
                                    </div>`;

            if (this.onsale && this.price == 0)
                price = `<div
                                        style="
                                            position: absolute;
                                            top: 10px;
                                            right: 10px;
                                        "
                                    >
                                        <div
                                            class="badge badge-info fw-semibold mb-1"
                                        >
                                            Free
                                        </div>
                                    </div>`;
            else if (!this.onsale)
                price = `<div
                                        style="
                                            position: absolute;
                                            top: 10px;
                                            right: 10px;
                                        "
                                    >
                                        <div
                                            class="badge badge-secondary fw-semibold mb-1"
                                        >
                                            <i
                                                class="fas fa-ban"
                                                style="width: 18px"
                                            ></i
                                            >Offsale
                                        </div>
                                    </div>`;

            if (this.limited) {
                header = `<div style="
                                            position: absolute;
                                            bottom: 10px;
                                            left: 10px;
                                        ">
                                        <div class="badge badge-witch fw-semibold mb-1">
                                            <i class="fas fa-star" style="width: 18px"></i>Rare
                                        </div>
                                    </div>`;
            } else if (this.timed) {
                header = `<div style="
                                            position: absolute;
                                            bottom: 10px;
                                            left: 10px;
                                        ">
                                        <div class="badge badge-danger fw-semibold mb-1">
                                            <i class="fas fa-clock" style="width: 18px"></i>Timed
                                        </div>
                                    </div>`;
            }

            $('#items').append(`<div class="cell large-2 medium-3 small-6">
                            <a href="${this.url}" class="d-block">
                                <div class="card position-relative p-2 mb-1">
								${price}
                                    <img src="${this.thumbnail}" />
                                </div>
                                <div
                                    class="text-body fw-semibold text-truncate"
                                >
                                    ${this.name}
                                </div>
                            </a>
                            <div class="text-xs fw-semibold">
                                <span class="text-muted">By</span>
                                <a href="${this.creator.url}"
                                    >@${this.creator.username}
                                </a>
                            </div>
                        </div>`);
        });

        if (data.total_pages > 1) {
            const previousDisabled = (data.current_page == 1) ? 'disabled' : '';
            const nextDisabled = (data.current_page == data.total_pages) ? 'disabled' : '';
            const previousPage = data.current_page - 1;
            const nextPage = data.current_page + 1;

            $('#items').append(`<div class="cell large-2 medium-3 small-6">
                            <a href="${this.url}" class="d-block">
                                <div class="card position-relative p-2 mb-1">
								${price}
                                    <img src="${this.thumbnail}" />
                                </div>
                                <div
                                    class="text-body fw-semibold text-truncate"
                                >
                                    ${this.name}
                                </div>
                            </a>
                            <div class="text-xs fw-semibold">
                                <span class="text-muted">By</span>
                                <a href="${this.creator.url}"
                                    >@${this.creator.username}
                                </a>
                            </div>
                        </div>`);
        }
    }).fail(() => $('#items').html('<div class="col">Unable to get items.</div>'));;
}
