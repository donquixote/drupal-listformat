<?php

namespace Drupal\listformat\LfConfigurator;

use Drupal\listformat\ListFormat\LfBrokenListFormat;
use Drupal\renderkit\ListFormat\ListFormatInterface;
use Drupal\cfrapi\RawConfigurator\RawConfigurator_CfrDecoratorTrait;

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
   */
  public function confGetListFormat(array $conf) {
    $handlerCandidate = $this->decorated->confGetValue($conf);
    if ($handlerCandidate instanceof ListFormatInterface) {
      return $handlerCandidate;
    }
    return LfBrokenListFormat::create()->setInvalidHandler($handlerCandidate);
  }

}
