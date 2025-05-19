<?php 
namespace App\Livewire;

use App\Http\Requests\Mails\ContactRequest;
use App\Services\MailService;
use Livewire\Component;
use WireUi\Traits\WireUiActions;

class ContactForm extends Component
{
    use WireUiActions;

    public $first_name, $last_name, $email, $phone, $message;

    public function submit()
    {
        // 1. validate against rules defined in ContactRequest
        $validated = $this->validate((new ContactRequest)->rules());

        // 2. send the data
        $this->send($validated);

        // 3. reset & flash
        session()->flash('success', 'Message sent successfully!');
        $this->reset();
    }

    /** show a WireUI toast */
    protected function successNotification(): void
    {
        $this->notification()->success(
            title: 'Message sent!',
            description: 'Thanks for contacting us.'
        );
    }

    /** NO type-hint here – accept the validated array */
    protected function send(array $data): void
    {
        $sent = app(MailService::class)->send($data);

        if ($sent) {
            $this->successNotification();
        }

        $this->first_name = "";
        $this->last_name = "";
        $this->email = "";
        $this->phone = "";
        $this->message = "";
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
