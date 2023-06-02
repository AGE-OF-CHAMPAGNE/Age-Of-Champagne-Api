<?php

namespace App\Controller;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class EmailController extends AbstractController
{
    #[Route('/send-email', name: 'send_email', methods: ['POST'])]
    public function sendEmail(Request $request, MailerInterface $mailer): Response
    {
     $addres = $request->request->get("email");
     $email = (new Email())
         ->from('hello@example.com')
         ->to('gleb.bushukin@gmail.com')
         //->cc('cc@example.com')
         //->bcc('bcc@example.com')
         //->replyTo('fabien@example.com')
         //->priority(Email::PRIORITY_HIGH)
         ->subject('Time for Symfony Mailer!')
         ->text('Sending emails is fun again!')
         ->html('<p>See Twig integration for better HTML integration!</p>');
     
     try {
          $mailer->send($email);
          return new Response("ok". $addres);

      } catch (TransportExceptionInterface $e) {
          return new Response("not ok" . $e->__toString());

      }
     // ...
 }
}

