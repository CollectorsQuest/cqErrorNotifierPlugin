<?php

require_once __DIR__ . '/include.php';

/**
 *
 * @package    fpErrorNotifier
 * @subpackage config
 *
 * @author     Maksim Kotlyar <mkotlar@ukr.net>
 */
class cqErrorNotifierPluginConfiguration extends sfPluginConfiguration
{
  /**
   *
   * @return void
   */
  public function initialize()
  {
    $this->_initializeConfig();
    $this->notifier()->handler()->initialize();
  }

  /**
   *
   * @return fpErrorNotifier
   */
  protected function notifier()
  {
    if (!$instance = fpErrorNotifier::getInstance())
    {
      $instance = new fpErrorNotifier($this->configuration->getEventDispatcher());
      fpErrorNotifier::setInstance($instance);
    }

    return $instance;
  }

  /**
   *
   * @return void
   */
  protected function _initializeConfig()
  {
    /** @var $configFiles array */
    $configFiles = $this->configuration->getConfigPaths('config/notify.yml');

    /** @var $config array */
    $config = sfDefineEnvironmentConfigHandler::getConfiguration($configFiles);

    foreach ($config as $name => $value) {
      sfConfig::set("sf_notify_{$name}", $value);
    }
  }
}
