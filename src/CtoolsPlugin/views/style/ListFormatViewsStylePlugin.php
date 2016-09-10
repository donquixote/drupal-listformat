<?php

namespace Drupal\listformat\CtoolsPlugin\views\style;

use Drupal\cfrapi\SummaryBuilder\SummaryBuilder_Static;

class ListFormatViewsStylePlugin extends ViewsStylePluginBase {

  /**
   * Set default options
   */
  public function option_definition() {
    $options = parent::option_definition();

    $options['listformat'] = array('default' => array());

    return $options;
  }

  /**
   * Render the given style.
   *
   * @param array $form
   * @param array $form_state
   */
  public function options_form(&$form, &$form_state) {
    parent::options_form($form, $form_state);

    if (isset($form_state['values']['style_options']['listformat'])) {
      $conf = $form_state['values']['style_options']['listformat'];
    }
    elseif (isset($form_state['input']['style_options']['listformat'])) {
      $conf = $form_state['input']['style_options']['listformat'];
    }
    else {
      $conf = $this->options['listformat'];
    }

    $form['listformat'] = listformat()->confGetForm($conf, t('List format'));
  }

  /**
   * Returns the summary of the settings in the display.
   */
  public function summary_title() {
    return listformat()->confGetSummary($this->options['listformat'], new SummaryBuilder_Static());
  }

  /**
   * @param string[] $rows
   * @param string $title
   * @param int $grouping_level
   *
   * @return string
   */
  protected function renderRows(array $rows, $title, $grouping_level) {
    $builds = array();
    foreach ($rows as $delta => $row_html) {
      $builds[$delta]['#markup'] = $row_html;
    }
    $listformat = listformat()->confGetListFormat($this->options['listformat']);
    $build = $listformat->buildList($builds);
    return drupal_render($build);
  }

}
