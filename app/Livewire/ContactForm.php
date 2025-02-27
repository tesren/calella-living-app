<?php

namespace App\Livewire;

use App\Mail\NewLead;
use App\Models\Message;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Mail;
use Spatie\Honeypot\Http\Livewire\Concerns\HoneypotData;
use Spatie\Honeypot\Http\Livewire\Concerns\UsesSpamProtection;

class ContactForm extends Component
{
    use UsesSpamProtection;

    #[Validate('required')] 
    public $full_name = '';
 
    #[Validate('required')] 
    public $contact_email = '';

    public $contact_phone = '';
    public $message = '';
    public $url = '';

    public HoneypotData $extraFields;

    
    public function mount()
    {
        $this->extraFields = new HoneypotData();
        $this->url = request()->fullUrl();
    }


    public function render()
    {
        return view('components.contact-form');
    }
    

    public function save()
    {
        $this->validate(); 
        $this->protectAgainstSpam();

        $msg = new Message();

        $msg->name = $this->full_name;
        $msg->email = $this->contact_email;
        $msg->phone = $this->contact_phone;
        $msg->content = $this->message;
        $msg->url = $this->url;
        $msg->save();


        //$email = Mail::to('info@domusvallarta.com')->bcc('ventas@punto401.com');
    
        $email = Mail::to('erick@punto401.com');
        
        $email->send(new NewLead($msg));

        session()->flash('message', 'Mensaje enviado exitosamente');

        $this->reset();

    }
}
