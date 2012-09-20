<?php

/** @var $configFiles array */
$configFiles = $this->getConfigPaths('config/notify.yml');

/** @var $config array */
$config = sfDefineEnvironmentConfigHandler::getConfiguration($configFiles);

foreach ($config as $name => $value) {
  sfConfig::set("sf_notify_{$name}", $value);
}

fpErrorNotifier::setInstance(new fpErrorNotifier($this->getEventDispatcher()));
fpErrorNotifier::getInstance()->handler()->initialize();
