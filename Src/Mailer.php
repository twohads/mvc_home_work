<?php

namespace Src;


class Mailer
{
    public function send($userEmail, $imageName, $name)
    {
        $transport = (new \Swift_SmtpTransport('smtp.mail.ru', 465, 'ssl'))
            ->setUsername('test-mail20@bk.ru')
            ->setPassword('jN123estMail20');
        // Create the Mailer using your created Transport
        $mailer = new \Swift_Mailer($transport);

        // Create a message
        $message = (new \Swift_Message('Вы успешно зарегистрированы'))
            ->setFrom(['test-mail20@bk.ru' => 'Павел Ольховой'])
            ->setTo([$userEmail => 'Вы успешно зарегистрированы'])
            ->setBody("$name, текстовое описание")
            ->attach(\Swift_Attachment::fromPath("../public/images/$imageName"));

        // Send the message
        $result = $mailer->send($message);
    }
}

