<?php

namespace Drupal\assignments;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Assignment entity.
 *
 * @see \Drupal\assignments\Entity\Assignment.
 */
class AssignmentAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\assignments\Entity\AssignmentInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished assignment entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published assignment entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit assignment entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete assignment entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add assignment entities');
  }

}
