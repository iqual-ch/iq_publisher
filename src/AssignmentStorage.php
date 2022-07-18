<?php

namespace Drupal\assignments;

use Drupal\Core\Entity\Sql\SqlContentEntityStorage;
use Drupal\discoverable_entity_bundle_classes\Storage\SqlContentEntityStorageTrait;

class AssignmentStorage extends SqlContentEntityStorage
{
    use SqlContentEntityStorageTrait;
}
