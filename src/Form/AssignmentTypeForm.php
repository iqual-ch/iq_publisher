<?php

namespace Drupal\assignments\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class AssignmentTypeForm.
 */
class AssignmentTypeForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $assignment_type = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $assignment_type->label(),
      '#description' => $this->t("Label for the Assignment type."),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $assignment_type->id(),
      '#machine_name' => [
        'exists' => '\Drupal\assignments\Entity\AssignmentType::load',
      ],
      '#disabled' => !$assignment_type->isNew(),
    ];

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $assignment_type = $this->entity;
    $status = $assignment_type->save();

    switch ($status) {
      case SAVED_NEW:
        $this->messenger()->addMessage($this->t('Created the %label Assignment type.', [
          '%label' => $assignment_type->label(),
        ]));
        break;

      default:
        $this->messenger()->addMessage($this->t('Saved the %label Assignment type.', [
          '%label' => $assignment_type->label(),
        ]));
    }
    $form_state->setRedirectUrl($assignment_type->toUrl('collection'));
  }
}
