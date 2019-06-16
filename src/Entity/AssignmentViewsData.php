<?php

namespace Drupal\iq_publisher\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Assignment entities.
 */
class AssignmentViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Additional information for Views integration, such as table joins, can be
    // put here.

    return $data;
  }

}
