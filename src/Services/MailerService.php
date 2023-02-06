<?php

namespace App\Services;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerService
{
    public function __construct(private MailerInterface $mailer)
    {
    }

    public function sendEmail(
        string $emailTo = 'admin@megstudio.com',
        string $subject = 'This is the Mail subject !',
        string $content = '',
        string $text = ''
    ): void {
        $email = (new Email())
            ->from('mailer@megstudio.com')
            ->to($emailTo)
            ->subject($subject)
            ->text($text)
            ->html($content);
        $this->mailer->send($email);
    }
}