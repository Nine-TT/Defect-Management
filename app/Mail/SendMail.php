<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    public $type;
    public $content="";
    /**
     * Create a new message instance.
     */
    public function __construct( $user, $type,  $content ){
        $this->user = $user;
        $this->type = $type;
        $this->content = $content;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        switch ($this->type){
            case "project-invitation":
                $subject = 'Thông báo tham gia dự án';
                break;
            case "assign-task":
                $subject = "Thông báo việc được giao";
                break;
            case "update-task":
                $subject = "[BUG] ".$this->content['errorName']." thay đổi";
                break;
            default:
                $subject = "Thông báo";
        }

        return new Envelope(
            subject: $subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $view = '';

        switch ($this->type){
            case "project-invitation":
                $view = 'mail.project_invitation';
                break;
            case "assign-task":
                $view = "mail.assigned_reporter";
                break;
            case "update-task":
                $view = "mail.update-task";
                break;
            default:
                $subject = "Thông báo";
        }

        return new Content(
            view: $view,
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    public function build()
    {
        $user = $this->user;
        $type = $this->type;
        $content = $this->content;

        return $this->to($this->user->email)
            ->with(compact('user', 'type', 'content'));
    }
}
