<div>
    <form wire:submit.prevent="submit" data-aos="fade-right" data-aos-duration="1000">
        <div class="row mt-16">
            <div class="col-md-6">
                <div class="single-input">
                    <input type="text" wire:model.defer="first_name" placeholder="First Name" required>
                    @error('first_name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="single-input">
                    <input type="text" wire:model.defer="last_name" placeholder="Last Name" required>
                    @error('last_name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="single-input">
                    <input type="email" wire:model.defer="email" placeholder="Email Address" required>
                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="single-input">
                    <input type="tel" wire:model.defer="phone" placeholder="Phone Number">
                    @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="single-input">
                    <textarea wire:model.defer="message" rows="5" placeholder="How can we help you?" required></textarea>
                    @error('message') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="button mt-30">
                    <button class="theme-btn3" type="submit">
                        Send <span class="arrow1"><i class="fa-solid fa-arrow-right"></i></span>
                        <span class="arrow2"><i class="fa-solid fa-arrow-right"></i></span>
                    </button>
                </div>
            </div>
        </div>

        @if (session()->has('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif
    </form>
</div>
