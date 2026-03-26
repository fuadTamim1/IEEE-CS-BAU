<?php

namespace App\Livewire;

use App\Models\Subscriber;
use Livewire\Component;
use WireUi\Traits\WireUiActions;

class NewsletterForm extends Component
{
    use WireUiActions;

    public string $email = '';

    public function submit(): void
    {
        $data = $this->validate([
            'email' => ['required', 'email', 'max:255'],
        ]);

        if (Subscriber::where('email', $data['email'])->exists()) {
            $this->notification()->warning(
                title: 'Already subscribed',
                description: 'This email is already on our newsletter list.'
            );

            return;
        }

        Subscriber::create([
            'email' => $data['email'],
            'options' => 'ALL',
        ]);

        $this->notification()->success(
            title: 'Subscribed successfully!',
            description: 'You are now on our newsletter list.'
        );

        $this->reset('email');
    }

    public function render()
    {
        return view('livewire.newsletter-form');
    }
}
