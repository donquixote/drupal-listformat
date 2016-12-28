<?php

namespace Drupal\listformat\LfConfigurator;

use Drupal\cfrapi\Exception\InvalidConfigurationException;
use Drupal\cfrapi\RawConfigurator\RawConfigurator_CfrDecoratorTrait;
use Drupal\renderkit\ListFormat\ListFormatInterface;

class LfConfigurator implements LfConfiguratorInterface {

  use RawConfigurator_CfrDecoratorTrait;

  /**
   * @return \Drupal\listformat\LfConfigurator\LfConfiguratorInterface
   */
  public static function create() {
    $lfHandlerMap = cfrplugin()->interfaceGetConfigurator(ListFormatInterface::class);
    return new LfConfigurator($lfHandlerMap);
  }

  /**
   * @param array $conf
   *
   * @return \Drupal\renderkit\ListFormat\ListFormatInterface
   *
   * @throws \Drupal\cfrapi\Exception\InvalidConfigurationException
   */
  public function confGetListFormat(array $conf) {

    $handlerCandidate = $this->decorated->confGetValue($conf);

    if ($handlerCandidate instanceof ListFormatInterface) {
      return $handlerCandidate;
    }

    throw new InvalidConfigurationException("The configurator returned something other than a list format.");
  }

}
