<x-base-layout>
    <!--===== HERO AREA START =====-->

    <div class="inner-hero" style="background-image: url({{ asset('images/team_bg.png') }});">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 m-auto text-center lightmode-bg">
                    <div class="inner-main-heading">
                        <h1>Our Team Member</h1>
                        <div class="breadcrumbs-pages">
                            <ul>
                                <li><a href="index.html">Home</a></li>
                                <li class="angle"><i class="fa-solid fa-angle-right"></i></li>
                                <li>Our Team Member</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--===== HERO AREA START =====-->

    <!--===== TEAM AREA START =====-->

    <div class="team2 sp">
        <div class="container">
            <div class="team-switcher" data-team-switcher>
                <div class="team-switcher__tabs" role="tablist" aria-label="Team categories">
                    <button type="button" class="team-switcher__tab is-active" role="tab" aria-selected="true"
                        data-team-tab="committee">Committee</button>
                    <button type="button" class="team-switcher__tab" role="tab" aria-selected="false"
                        data-team-tab="members">Members</button>
                </div>

                <div class="team-switcher__panel is-active" role="tabpanel" data-team-panel="committee">
                    @if ($committeeMembers->count())
                        <div class="row mt-20">
                            @foreach ($committeeMembers as $m)
                                <x-team-member-card name="{{ $m->name }}" role="{{ $m->title }}" :links="$m->contacts" />
                            @endforeach
                        </div>
                    @else
                        <div class="row mt-20">
                            <div class="col-12">
                                <p>No committee members found yet.</p>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="team-switcher__panel" role="tabpanel" data-team-panel="members" hidden>
                    @if ($regularMembers->count())
                        <div class="row mt-20">
                            @foreach ($regularMembers as $m)
                                <x-team-member-card name="{{ $m->name }}" role="{{ $m->title }}" :links="$m->contacts" />
                            @endforeach
                        </div>
                    @else
                        <div class="row mt-20">
                            <div class="col-12">
                                <p>No members found yet.</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Pagenation --}}
            {{-- 
        <div class="space60"></div>
        <div class="row">
            <div class="col-12 m-auto">
               <div class="theme-pagination text-center">
                <ul>
                    <li><a href="#"><i class="fa-solid fa-angle-left"></i></a></li>
                    <li><a class="active" href="#">01</a></li>
                    <li><a href="#">02</a></li>
                    <li>...</li>
                    <li><a href="#">12</a></li>
                    <li><a href="#"><i class="fa-solid fa-angle-right"></i></a></li>
                </ul>
               </div>
            </div>
        </div> --}}

        </div>
    </div>

    <!--===== TEAM AREA END =====-->

    @push('styles')
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
                border: 0;
                border-radius: 999px;
                padding: 0.75rem 1.35rem;
                font-weight: 700;
                color: #475569;
                background: #e2e8f0;
                transition: background-color 0.2s ease, color 0.2s ease, box-shadow 0.2s ease;
            }

            .team-switcher__tab.is-active {
                color: #1f2937;
                background: #fbbf24;
                box-shadow: 0 8px 22px rgba(251, 191, 36, 0.4);
            }

            .team-switcher__panel {
                animation: fadeInTeamPanel 0.24s ease;
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
    @endpush

    @section('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('[data-team-switcher]').forEach(function(switcher) {
                    var tabs = switcher.querySelectorAll('[data-team-tab]');
                    var panels = switcher.querySelectorAll('[data-team-panel]');

                    tabs.forEach(function(tab) {
                        tab.addEventListener('click', function() {
                            var target = tab.getAttribute('data-team-tab');

                            tabs.forEach(function(otherTab) {
                                var isActive = otherTab === tab;
                                otherTab.classList.toggle('is-active', isActive);
                                otherTab.setAttribute('aria-selected', isActive ? 'true' : 'false');
                            });

                            panels.forEach(function(panel) {
                                var isActive = panel.getAttribute('data-team-panel') === target;
                                panel.classList.toggle('is-active', isActive);
                                panel.hidden = !isActive;
                            });
                        });
                    });
                });
            });
        </script>
    @endsection
</x-base-layout>
