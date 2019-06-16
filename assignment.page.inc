<?php

/**
 * @file
 * Contains assignment.page.inc.
 *
 * Page callback for Assignment entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Assignment templates.
 *
 * Default template: assignment.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_assignment(array &$variables) {
  // Fetch Assignment Entity Object.
  $assignment = $variables['elements']['#assignment'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
