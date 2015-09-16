<?php

namespace Drupal\listformat\Plugin\views\style;

abstract class ViewsStylePluginBase extends \views_plugin_style {

  /**
   * Render the grouping sets.
   *
   * Plugins may override this method if they wish some other way of handling
   * grouping.
   *
   * @param $sets
   *   Array containing the grouping sets to render.
   * @param $level
   *   Integer indicating the hierarchical level of the grouping.
   *
   * @return string
   *   Rendered output of given grouping sets.
   */
  function render_grouping_sets($sets, $level = 0) {
    $output = '';
    foreach ($sets as $set) {
      $row = reset($set['rows']);
      // Render as a grouping set.
      if (is_array($row) && isset($row['group'])) {
        $output .= theme(views_theme_functions('views_view_grouping', $this->view, $this->display),
          array(
            'view' => $this->view,
            'grouping' => $this->options['grouping'][$level],
            'grouping_level' => $level,
            'rows' => $set['rows'],
            'title' => $set['group'])
        );
      }
      // Render as a record set.
      else {
        if ($this->uses_row_plugin()) {
          foreach ($set['rows'] as $index => $row) {
            $this->view->row_index = $index;
            $set['rows'][$index] = $this->row_plugin->render($row);
          }
        }

        $output .= $this->renderRows($set['rows'], $set['group'], $level);
      }
    }
    unset($this->view->row_index);
    return $output;
  }

  /**
   * @param string[] $rows
   * @param string $title
   * @param int $grouping_level
   *
   * @return string
   */
  abstract protected function renderRows(array $rows, $title, $grouping_level);

}
