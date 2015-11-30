<?php

namespace Drupal\listformat\Manager;

use Drupal\listformat\ListFormat\LfBrokenListFormat;
use Drupal\renderkit\ListFormat\ListFormatInterface;
use Drupal\uniplugin\Manager\UniHandlerMapDecoratorTrait;

class LfManager implements LfManagerInterface {

  use UniHandlerMapDecoratorTrait;

  /**
   * @param array $conf
   *
   * @return \Drupal\renderkit\ListFormat\ListFormatInterface
   */
  function confGetListFormat(array $conf) {
    $handlerCandidate = $this->handlerMap->confGetHandler($conf);
    if ($handlerCandidate instanceof ListFormatInterface) {
      return $handlerCandidate;
    }
    return LfBrokenListFormat::create()->setInvalidHandler($handlerCandidate);
  }

}
