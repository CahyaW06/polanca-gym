<?php

namespace App\Mail;

use App\Models\History;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;
use MailerSend\Helpers\Builder\Personalization;
use MailerSend\Helpers\Builder\Variable;
use MailerSend\LaravelDriver\MailerSendTrait;

class PaymentConfirmEmail extends Mailable
{
    use Queueable, SerializesModels, MailerSendTrait;

    /**
     * Create a new message instance.
     */
    public function __construct(protected History $history, protected Setting $lastSetting)
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Payment Confirm Polanca Gym',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $to = Arr::get($this->to, '0.address');

        // Additional options for MailerSend API features
        $this->mailersend(
            template_id: null,
            variables: [
                new Variable($to, ['name' => 'Your Name'])
            ],
            tags: ['tag'],
            personalization: [
                new Personalization($to, [
                    'var' => 'variable',
                    'number' => 123,
                    'object' => [
                        'key' => 'object-value'
                    ],
                    'objectCollection' => [
                        [
                            'name' => 'John'
                        ],
                        [
                            'name' => 'Patrick'
                        ]
                    ],
                ])
            ],
            precedenceBulkHeader: true,
            // sendAt: new Carbon('2022-01-28 11:53:20'),
        );

        return new Content(
            view: 'emails.sendPayment',
            with: [
                'user' => $this->history->user,
                'membership_type' => $this->history->membership_type,
                'lastSetting' => $this->lastSetting,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromStorage('membership_recipients/'.$this->history->proof)
        ];
    }
}
