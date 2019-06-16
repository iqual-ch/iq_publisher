<?php

namespace Drupal\iq_publisher\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Assignment entities.
 *
 * @ingroup iq_publisher
 */
interface AssignmentInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Assignment name.
   *
   * @return string
   *   Name of the Assignment.
   */
  public function getName();

  /**
   * Sets the Assignment name.
   *
   * @param string $name
   *   The Assignment name.
   *
   * @return \Drupal\iq_publisher\Entity\AssignmentInterface
   *   The called Assignment entity.
   */
  public function setName($name);

  /**
   * Gets the Assignment creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Assignment.
   */
  public function getCreatedTime();

  /**
   * Sets the Assignment creation timestamp.
   *
   * @param int $timestamp
   *   The Assignment creation timestamp.
   *
   * @return \Drupal\iq_publisher\Entity\AssignmentInterface
   *   The called Assignment entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Assignment published status indicator.
   *
   * Unpublished Assignment are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Assignment is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Assignment.
   *
   * @param bool $published
   *   TRUE to set this Assignment to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\iq_publisher\Entity\AssignmentInterface
   *   The called Assignment entity.
   */
  public function setPublished($published);

}
