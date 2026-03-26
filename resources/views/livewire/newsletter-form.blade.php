<div class="cta4-form-area text-center">
    <h2>Join Our Newsletter</h2>

    <form wire:submit.prevent="submit" class="d-flex gap-3 mt-4">
        <input
            type="email"
            wire:model.defer="email"
            placeholder="Enter Your Email"
            class="form-control"
            required
        >
        <input type="submit" class="newletter-btn" value="Subscribe">
    </form>

    @error('email')
        <p class="text-danger mt-2 mb-0">{{ $message }}</p>
    @enderror
</div>
