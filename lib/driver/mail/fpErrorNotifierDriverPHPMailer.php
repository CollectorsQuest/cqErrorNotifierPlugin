<?php

require_once __DIR__ . '/fpBaseErrorNotifierDriverMail.php';
require_once __DIR__ . '/../../vendor/class.phpmailer.php';

/**
 *
 * @package    fpErrorNotifier
 * @subpackage driver
 *
 * @author     Maksim Kotlyar <mkotlar@ukr.net>
 */
class fpErrorNotifierDriverPHPMailer extends fpBaseErrorNotifierDriverMail
{
  /**
   *
   * @param fpBaseErrorNotifierMessage $message
   */
  public function notify(fpBaseErrorNotifierMessage $message)
  {
    $mailer = new PHPMailer();

    $mailer->IsSMTP();
    $mailer->SMTPAuth   = true;
    $mailer->Host       = 'ssl://email-smtp.us-east-1.amazonaws.com';
    $mailer->Username   = $this->getOption('username');
    $mailer->Password   = $this->getOption('password');
    $mailer->Port       = 465;
    $mailer->Timeout    = 5;

    $mailer->SetFrom($this->getOption('from'), 'Collectors Quest');
    $mailer->AddAddress($this->getOption('to'), 'Developers');
    $mailer->ClearReplyTos();
    $mailer->AddReplyTo('developers@collectorsquest.com', 'Developers');

    $mailer->Subject = $message->subject();
    $mailer->MsgHTML((string) $message);

    @$mailer->Send();
  }
}
