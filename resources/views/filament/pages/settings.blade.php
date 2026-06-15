<x-filament::page>
    <div class="mb-4 rounded-xl border border-amber-300/70 bg-amber-50 p-4 text-amber-900">
        Settings are saved with normalization and validation. Most toggles apply immediately; infrastructure features
        still depend on their dedicated runtime modules.
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
