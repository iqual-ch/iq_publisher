<?php

namespace Drupal\assignments\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Assignment type entity.
 *
 * @ConfigEntityType(
 *   id = "assignment_type",
 *   label = @Translation("Assignment type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\assignments\AssignmentTypeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\assignments\Form\AssignmentTypeForm",
 *       "edit" = "Drupal\assignments\Form\AssignmentTypeForm",
 *       "delete" = "Drupal\assignments\Form\AssignmentTypeDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\assignments\AssignmentTypeHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "assignment_type",
 *   admin_permission = "administer site configuration",
 *   bundle_of = "assignment",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/assignment_type/{assignment_type}",
 *     "add-form" = "/admin/structure/assignment_type/add",
 *     "edit-form" = "/admin/structure/assignment_type/{assignment_type}/edit",
 *     "delete-form" = "/admin/structure/assignment_type/{assignment_type}/delete",
 *     "collection" = "/admin/structure/assignment_type"
 *   }
 * )
 */

class AssignmentType extends ConfigEntityBundleBase implements AssignmentTypeInterface {

  /**
   * The Assignment type ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Assignment type label.
   *
   * @var string
   */
  protected $label;

}
