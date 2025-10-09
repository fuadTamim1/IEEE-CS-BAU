<x-filament::page>
    <div>
        <x-alert
            style="background: #42241557;
    padding: 1rem;
    border: 2px solid #3f0000;
    border-radius: 10px;
    color: #8d5e05;">
            <h2>* The Setting is still under-development they are not fully funcational yet.</h2>
        </x-alert>
    </div>
    <form wire:submit.prevent="save">
        {{ $this->form }}

        <div class="mt-6 flex justify-end">
            <x-filament::button type="submit">
                Save Settings
            </x-filament::button>
        </div>
    </form>
</x-filament::page>
