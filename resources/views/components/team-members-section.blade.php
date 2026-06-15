@props([
    'members',
    'activeTab' => 'committee',
    'mode' => 'pagination',
    'anchorId' => 'ourteam',
    'loadMoreUrl' => null,
])

@php
    $isPaginationMode = $mode === 'pagination';
    $isLoadMoreMode = $mode === 'load-more';
    $activeTab = in_array($activeTab, ['committee', 'members'], true) ? $activeTab : 'committee';
    $isPaginator = $members instanceof \Illuminate\Pagination\LengthAwarePaginator;
    $currentPage = $isPaginator ? $members->currentPage() : 1;
    $hasMore = $isPaginator ? $members->hasMorePages() : false;
    $requestTab = request()->query('team_tab', $activeTab);
    $requestPage = max((int) request()->query('team_page', 1), 1);
@endphp

<div class="team-switcher"
    data-team-switcher
    data-team-mode="{{ $mode }}"
    @if ($isLoadMoreMode)
        data-team-endpoint="{{ $loadMoreUrl }}"
        data-team-tab="{{ $activeTab }}"
        data-team-page="{{ $currentPage }}"
        data-team-has-more="{{ $hasMore ? '1' : '0' }}"
    @endif
>
    <div class="team-switcher__tabs" role="tablist" aria-label="Team categories">
        @if ($isPaginationMode)
            <a class="team-switcher__tab {{ $activeTab === 'committee' ? 'is-active' : '' }}"
                href="{{ route(Route::currentRouteName(), array_merge(request()->except(['team_tab']), ['team_tab' => 'committee', 'team_page' => $requestPage])) }}#{{ $anchorId }}"
                role="tab"
                aria-selected="{{ $activeTab === 'committee' ? 'true' : 'false' }}">
                Committee
            </a>
            <a class="team-switcher__tab {{ $activeTab === 'members' ? 'is-active' : '' }}"
                href="{{ route(Route::currentRouteName(), array_merge(request()->except(['team_tab']), ['team_tab' => 'members', 'team_page' => $requestPage])) }}#{{ $anchorId }}"
                role="tab"
                aria-selected="{{ $activeTab === 'members' ? 'true' : 'false' }}">
                Members
            </a>
        @else
            <button type="button"
                class="team-switcher__tab {{ $activeTab === 'committee' ? 'is-active' : '' }}"
                data-team-tab="committee"
                role="tab"
                aria-selected="{{ $activeTab === 'committee' ? 'true' : 'false' }}">
                Committee
            </button>
            <button type="button"
                class="team-switcher__tab {{ $activeTab === 'members' ? 'is-active' : '' }}"
                data-team-tab="members"
                role="tab"
                aria-selected="{{ $activeTab === 'members' ? 'true' : 'false' }}">
                Members
            </button>
        @endif
    </div>

    <div class="team-switcher__panel is-active" role="tabpanel" data-team-panel="active">
        <div class="row mt-20" data-team-grid>
            @include('components.team-members-grid', ['members' => $members])
        </div>

        @if ($isPaginationMode && $isPaginator && $members->hasPages())
            <div class="team-switcher__pagination mt-30">
                {{ $members->appends(['team_tab' => $activeTab])->fragment($anchorId)->links() }}
            </div>
        @endif

        @if ($isLoadMoreMode)
            <div class="team-switcher__load-more-wrap mt-30">
                <button type="button"
                    class="team-switcher__load-more"
                    data-team-load-more
                    @if (! $hasMore) disabled @endif>
                    {{ $hasMore ? 'Load More' : 'No More Members' }}
                </button>
            </div>
        @endif
    </div>
</div>

@once
    <style>
        .team-switcher {
            margin-top: 1.2rem;
        }

        .team-switcher__tabs {
            display: flex;
            flex-wrap: wrap;
            gap: 0.8rem;
            margin-bottom: 1.1rem;
        }

        .team-switcher__tab {
            text-decoration: none;
            border: 0;
            border-radius: 999px;
            padding: 0.75rem 1.35rem;
            font-weight: 700;
            color: #475569;
            background: #e2e8f0;
            transition: background-color 0.2s ease, color 0.2s ease, box-shadow 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .team-switcher__tab.is-active {
            color: #1f2937;
            background: #fbbf24;
            box-shadow: 0 8px 22px rgba(251, 191, 36, 0.4);
        }

        .team-switcher__panel {
            animation: fadeInTeamPanel 0.24s ease;
        }

        .team-switcher__empty {
            border: 1px dashed rgba(71, 85, 105, 0.35);
            border-radius: 12px;
            padding: 1rem;
            margin: 0;
            color: #334155;
            text-align: center;
            background: rgba(226, 232, 240, 0.2);
        }

        .team-switcher__pagination nav {
            display: flex;
            justify-content: center;
        }

        .team-switcher__load-more-wrap {
            display: flex;
            justify-content: center;
        }

        .team-switcher__load-more {
            border: 0;
            border-radius: 999px;
            padding: 0.75rem 1.5rem;
            background: #fbbf24;
            color: #1f2937;
            font-weight: 700;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .team-switcher__load-more:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 8px 22px rgba(251, 191, 36, 0.35);
        }

        .team-switcher__load-more:disabled {
            cursor: not-allowed;
            opacity: 0.55;
        }

        @keyframes fadeInTeamPanel {
            from {
                opacity: 0;
                transform: translateY(4px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var switchers = document.querySelectorAll('[data-team-switcher][data-team-mode="load-more"]');

            switchers.forEach(function(switcher) {
                var endpoint = switcher.getAttribute('data-team-endpoint');
                var activeTab = switcher.getAttribute('data-team-tab') || 'committee';
                var currentPage = parseInt(switcher.getAttribute('data-team-page') || '1', 10);
                var hasMore = switcher.getAttribute('data-team-has-more') === '1';
                var tabs = switcher.querySelectorAll('[data-team-tab]');
                var grid = switcher.querySelector('[data-team-grid]');
                var loadMoreBtn = switcher.querySelector('[data-team-load-more]');

                function renderButtonState() {
                    if (!loadMoreBtn) {
                        return;
                    }

                    loadMoreBtn.disabled = !hasMore;
                    loadMoreBtn.textContent = hasMore ? 'Load More' : 'No More Members';
                }

                function setActiveTab(targetTab) {
                    activeTab = targetTab;
                    tabs.forEach(function(tab) {
                        var isActive = tab.getAttribute('data-team-tab') === targetTab;
                        tab.classList.toggle('is-active', isActive);
                        tab.setAttribute('aria-selected', isActive ? 'true' : 'false');
                    });
                }

                function fetchMembers(page, append) {
                    if (!endpoint || !grid) {
                        return;
                    }

                    var query = '?team_tab=' + encodeURIComponent(activeTab) + '&page=' + encodeURIComponent(page);

                    fetch(endpoint + query, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                        .then(function(response) {
                            if (!response.ok) {
                                throw new Error('Failed to load members.');
                            }
                            return response.json();
                        })
                        .then(function(payload) {
                            if (!append) {
                                grid.innerHTML = payload.html;
                            } else {
                                var wrapper = document.createElement('div');
                                wrapper.innerHTML = payload.html;
                                while (wrapper.firstChild) {
                                    grid.appendChild(wrapper.firstChild);
                                }
                            }

                            currentPage = payload.currentPage;
                            hasMore = !!payload.hasMore;
                            renderButtonState();
                        })
                        .catch(function() {
                            hasMore = false;
                            renderButtonState();
                        });
                }

                tabs.forEach(function(tab) {
                    tab.addEventListener('click', function() {
                        var targetTab = tab.getAttribute('data-team-tab');
                        if (!targetTab) {
                            return;
                        }

                        setActiveTab(targetTab);
                        currentPage = 1;
                        hasMore = true;
                        renderButtonState();
                        fetchMembers(1, false);
                    });
                });

                if (loadMoreBtn) {
                    loadMoreBtn.addEventListener('click', function() {
                        if (!hasMore) {
                            return;
                        }

                        fetchMembers(currentPage + 1, true);
                    });
                }

                renderButtonState();
            });
        });
    </script>
@endonce
