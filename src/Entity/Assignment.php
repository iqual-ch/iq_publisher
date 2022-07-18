<?php

namespace Drupal\assignments\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\user\UserInterface;

/**
 * Defines the Assignment entity.
 *
 * @ingroup assignments
 *
 * @ContentEntityType(
 *   id = "assignment",
 *   label = @Translation("Assignment"),
 *   bundle_label = @Translation("Assignment type"),
 *   handlers = {
 *     "storage" = "Drupal\assignments\AssignmentStorage",
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\assignments\AssignmentListBuilder",
 *     "views_data" = "Drupal\assignments\Entity\AssignmentViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\assignments\Form\AssignmentForm",
 *       "add" = "Drupal\assignments\Form\AssignmentForm",
 *       "edit" = "Drupal\assignments\Form\AssignmentForm",
 *       "delete" = "Drupal\assignments\Form\AssignmentDeleteForm",
 *     },
 *     "access" = "Drupal\assignments\AssignmentAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\assignments\AssignmentHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "assignment",
 *   admin_permission = "administer assignment entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "bundle" = "type",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "uid" = "user_id",
 *     "langcode" = "langcode",
 *     "status" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/content/assignment/{assignment}",
 *     "add-page" = "/admin/content/assignment/add",
 *     "add-form" = "/admin/content/assignment/add/{assignment_type}",
 *     "edit-form" = "/admin/content/assignment/{assignment}/edit",
 *     "delete-form" = "/admin/content/assignment/{assignment}/delete",
 *     "collection" = "/admin/content/assignment",
 *   },
 *   bundle_entity_type = "assignment_type",
 *   field_ui_base_route = "entity.assignment_type.edit_form"
 * )
 */
class Assignment extends ContentEntityBase implements AssignmentInterface
{

    use EntityChangedTrait;

    /**
     * {@inheritdoc}
     */
    public static function preCreate(EntityStorageInterface $storage_controller, array &$values)
    {
        parent::preCreate($storage_controller, $values);
        $values += [
            'user_id' => \Drupal::currentUser()->id(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->get('name')->value;
    }

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->set('name', $name);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCreatedTime()
    {
        return $this->get('created')->value;
    }

    /**
     * {@inheritdoc}
     */
    public function setCreatedTime($timestamp)
    {
        $this->set('created', $timestamp);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getOwner()
    {
        return $this->get('user_id')->entity;
    }

    /**
     * {@inheritdoc}
     */
    public function getOwnerId()
    {
        return $this->get('user_id')->target_id;
    }

    /**
     * {@inheritdoc}
     */
    public function setOwnerId($uid)
    {
        $this->set('user_id', $uid);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setOwner(UserInterface $account)
    {
        $this->set('user_id', $account->id());
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isPublished()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function setPublished($published)
    {
        return $this;
    }

    public static function getMatches(array $options)
    {
        return [];
    }

    protected static function alterMatches(array $assignments, array $options)
    {
        return $assignments;
    }

    /**
     * {@inheritdoc}
     */
    public static function baseFieldDefinitions(EntityTypeInterface $entity_type)
    {
        $fields = parent::baseFieldDefinitions($entity_type);

        $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
            ->setLabel(t('Authored by'))
            ->setDescription(t('The user ID of author of the Assignment entity.'))
            ->setRevisionable(true)
            ->setSetting('target_type', 'user')
            ->setSetting('handler', 'default')
            ->setTranslatable(true)
            ->setDisplayOptions('view', [
                'label' => 'hidden',
                'type' => 'author',
                'weight' => 0,
            ])
            ->setDisplayOptions('form', [
                'type' => 'entity_reference_autocomplete',
                'weight' => 5,
                'settings' => [
                    'match_operator' => 'CONTAINS',
                    'size' => '60',
                    'autocomplete_type' => 'tags',
                    'placeholder' => '',
                ],
            ])
            ->setDisplayConfigurable('form', true)
            ->setDisplayConfigurable('view', true);

        $fields['name'] = BaseFieldDefinition::create('string')
            ->setLabel(t('Channel'))
            ->setDescription(t('The channel of the Assignment entity.'))
            ->setSettings([
                'max_length' => 50,
                'text_processing' => 0,
            ])
            ->setDefaultValue('')
            ->setDisplayOptions('view', [
                'label' => 'above',
                'type' => 'hidden',
                'weight' => -4,
            ])
            ->setDisplayOptions('form', [
                'type' => 'string_textfield',
                'weight' => -4,
            ])
            ->setDisplayConfigurable('form', true)
            ->setDisplayConfigurable('view', true)
            ->setRequired(true);

        $fields['created'] = BaseFieldDefinition::create('created')
            ->setLabel(t('Created'))
            ->setDescription(t('The time that the entity was created.'));

        $fields['changed'] = BaseFieldDefinition::create('changed')
            ->setLabel(t('Changed'))
            ->setDescription(t('The time that the entity was last edited.'));

        return $fields;
    }

}
