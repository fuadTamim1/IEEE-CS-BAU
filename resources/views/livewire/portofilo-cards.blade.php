<div class="row">
    <div class="row">
        <div class="col-lg-7 m-auto text-center">
            <div class="categories-buttons">
                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button wire:click="selectCategory(-1)" @class(["nav-link", "active" => $selected_category == -1])>All</button>
                    </li>
                    @foreach ($categories as $c)
                        <li class="nav-item" role="presentation">
                            <button wire:click="selectCategory({{ $c['id'] }})" @class(["nav-link", "active" => $selected_category == $c['id']])>{{ $c['title'] }}</button>
                        </li>
                    @endforeach
            </div>
        </div>
    </div>


    <div class="col-lg-12">
        <div class="portfolio-post-area">
            <div class="row mt-30">
                @foreach ($projects as $p)
                    <x-project-card :project=$p />
                @endforeach
            </div>
        </div>
    </div>

</div>
