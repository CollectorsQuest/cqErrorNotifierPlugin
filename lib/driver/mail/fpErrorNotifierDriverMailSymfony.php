<?php

require_once __DIR__ . '/fpBaseErrorNotifierDriverMail.php';

/**
 *
 * @package    fpErrorNotifier
 * @subpackage driver
 *
 * @author     Maksim Kotlyar <mkotlar@ukr.net>
 */
class fpErrorNotifierDriverMailSymfony extends fpBaseErrorNotifierDriverMail
{

  /**
   * (non-PHPdoc)
   * @see plugins/cqErrorNotifierPlugin/lib/driver/fpBaseErrorNotifierDriver#notify($message)
   */
  public function notify(fpBaseErrorNotifierMessage $message)
  {
    if (
      ($mailer = fpErrorNotifier::getInstance()->context()->getMailer()) &&
      !($mailer instanceof fpErrorNotifierNullObject)
    )
    {
      $swiftMessage = new Swift_Message();
      $swiftMessage
        ->setTo($this->getOption('to'))
        ->setFrom($this->getOption('from'))
        ->setSubject($message->subject())
        ->setBody((string) $message)
        ->setContentType($message->format());

      $mailer->send($swiftMessage);
    }
  }

}
