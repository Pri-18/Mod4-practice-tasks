<?php

namespace Drupal\custom_entity\Plugin\Validation\Constraint;

use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Constraint;

/**
 * Summary of PriceFieldConstraintValidator.
 */
class PriceFieldConstraintValidator extends ConstraintValidator {

  /**
   * {@inheritDoc}
   */
  public function validate(mixed $value, Constraint $constraint) {
    // Check that the field has a value.
    if (!$value || $value->isEmpty()) {
      return;
    }
    // Get the actual field value.
    $raw_value = $value->value;
    // Ensure it's numeric before casting.
    if (!is_numeric($raw_value)) {
      $this->context->addViolation('The price must be a numeric value.');
      return;
    }
    // Custom validation: price must be at least 100.
    if ($raw_value < 100) {
      $this->context->addViolation($constraint->msg);
    }
  }

}
