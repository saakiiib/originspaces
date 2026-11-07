<?php

namespace App\Mail;

use App\Models\CompanyDetails;
use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\SentMessage;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ContactEnquiryMail extends Mailable
{
    use Queueable, SerializesModels;

    public CompanyDetails $company;

    public function __construct(public Contact $contact)
    {
        $this->company = CompanyDetails::cached();
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Website Enquiry — '.$this->contact->name.' | OriginSpaces',
            from: new Address(
                config('mail.from.address') ?: 'hello@originspaces.uk',
                config('mail.from.name') ?: 'OriginSpaces'
            ),
            replyTo: [
                new Address($this->contact->email, $this->contact->name),
            ],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-enquiry',
            with: [
                'contact' => $this->contact,
                'company' => $this->company,
            ],
        );
    }

    public function sent(SentMessage $message): void
    {
        Log::info('ContactEnquiryMail handed to mailer', [
            'contact_id' => $this->contact->id,
            'to' => array_keys($message->getMessage()->getTo()),
            'subject' => $message->getMessage()->getSubject(),
            'mailer' => config('mail.default'),
        ]);
    }
}
