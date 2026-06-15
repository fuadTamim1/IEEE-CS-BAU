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
        if (!filter_var(get_setting('enable_contact_form', true), FILTER_VALIDATE_BOOLEAN)) {
            $this->notification()->warning(
                title: 'Contact form is unavailable',
                description: 'Please try again later.'
            );

            return;
        }

        $validated = $this->validate((new ContactRequest)->rules());
        $result = $this->send($validated);

        if ($result['saved'] && $result['mail_sent']) {
            session()->flash('success', 'Message sent successfully!');
            $this->successNotification();
            $this->reset();

            return;
        }

        if ($result['saved']) {
            session()->flash('success', 'Message received successfully. We will reply to you soon.');
            $this->notification()->warning(
                title: 'Message saved',
                description: 'Your message was saved, but email notification is temporarily unavailable.'
            );
            $this->reset();

            return;
        }

        $this->notification()->error(
            title: 'Message not sent',
            description: 'Please try again in a few minutes.'
        );
    }

    protected function successNotification(): void
    {
        $this->notification()->success(
            title: 'Message sent!',
            description: 'Thanks for contacting us.'
        );
    }

    protected function send(array $data): array
    {
        return app(MailService::class)->sendContactSubmission($data);
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
