document.querySelectorAll('[data-tooltip-title]').forEach(function (element) {
    tippy(element, {
        content: element.getAttribute('data-tooltip-title'),
        placement: element.getAttribute('data-tooltip-placement') || 'top',
        allowHTML: element.hasAttribute('data-tooltip-html'),
        arrow: false,
    });
});

// Target must have the "hide" class initially
document.querySelectorAll('[data-toggle-element]').forEach(function (element) {
    const target = document.querySelector(element.getAttribute('data-toggle-element'));

    if (!target) return;

    element.onclick = function () {
        target.classList.toggle('hide');
    };
});

document.getElementById('sidebar-toggler').onclick = function () {
    document.querySelector('.sidebar').classList.toggle('show-for-large');
};

document.querySelectorAll('[data-toggle-modal]').forEach(function (element) {
    const targetId = element.getAttribute('data-toggle-modal');
    const target = document.querySelector(targetId);

    if (!target) return;

    element.onclick = function () {
        const active = target.classList.contains('active');
        const className = active ? 'modal-animation-reverse' : 'modal-animation';

        document.body.style.overflowY = !active ? 'hidden' : '';
        document.body.classList.add(className);

        if (active) {
            target.onclick = null;
        } else {
            target.classList.add('active');
            target.onclick = function (event) {
                if (targetId == `#${event.target.id}`) {
                    element.click();
                }
            };
        }

        setTimeout(function () {
            if (active) {
                target.classList.remove('active');
            }

            document.body.classList.remove(className);
        }, active ? 200 : 400);
    };
});

document.querySelectorAll('.dropdown').forEach(function (element) {
    document.addEventListener('click', function (event) {
        const active = element.classList.contains('active');
        const matches = event.target.matches('.dropdown, .dropdown *');

        if (active && !matches) {
            element.click();
        }
    });

    element.addEventListener('click', function (event) {
        element.classList.toggle('active');
    });
});

document.querySelectorAll('.collapsible').forEach(function (element) {
    element.addEventListener('click', function (event) {
        if (!event.target.parentNode.classList.contains('collapsible-menu')) {
            element.classList.toggle('active');
        }
    });
});

document.getElementById('global-search-bar').addEventListener('keyup', function (event) {
    const $results = document.getElementById('global-search-results');
    const query = event.target.value;

    if (query.length == 0) {
        $results.classList.add('hide');
        $results.innerHTML = '';
        return;
    }

    clearTimeout(window.searchDelay);

    window.searchDelay = setTimeout(function () {
        // jquery is gay and retarded
        $.get('/api/search/all', {
            search: query,
        }).done(function(data) {
            $results.classList.add('hide');

            if (typeof data.error !== 'undefined' && data.error) {
                $results.innerHTML = `
                <li class="dropdown-title">Error</li>
                <li class="dropdown-item">${data.error}</li>`;
                return;
            }

            $results.innerHTML = '<li class="dropdown-title">Quick Results</li>';

            $.each(data, function() {
                $results.innerHTML += `
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
                </li>`;
            });

            $results.classList.remove('hide');
        }).fail(function () {
            $results.innerHTML = `
            <li class="dropdown-title">Error</li>
            <li class="dropdown-item">No results found.</li>`;
        });
    }, 500);
});