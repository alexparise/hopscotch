<?php

namespace Shared\Request;

use Shared\Common\Common;
use Shared\Request\Exception\ValidationException;

class RequestValidator {

    const PARAM_TYPE = 'type';

    const PARAM_REQUIRED = 'required';

    const PARAM_MAXLENGTH = 'max_length';

    const PARAM_MINLENGTH = 'min_length';

    const PARAM_MATCH = 'match';

    const TYPE_STRING = 'string';

    const TYPE_EMAIL = 'email';

    const TYPE_PASSWORD = 'password';

    const EMAIL_VALIDATION_REGEX = '/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/i';

    const PASSWORD_VALIDATION_REGEX = '/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,255}$/';

    protected static $errors = array();

    protected static function validate() {
        foreach (static::$allowedParameters as $input => $rules) {
            $value = Common::getValue(static::$requestVariables, $input, null);

            $required = Common::getValue($rules, static::PARAM_REQUIRED, false);
            if ($required && $value === null) {
                static::$errors[] = ucfirst($input) . ' is a required field.';
                continue;
            }

            $validatorFunction = 'validate' . ucfirst(Common::getValue($rules, static::PARAM_TYPE));
            static::$validatorFunction($input, $value, $rules);
            if (isset($rules[static::PARAM_MATCH])) {
                if ($value !== Common::getValue(static::$requestVariables, Common::getValue($rules, static::PARAM_MATCH), null)) {
                    static::$errors[] = ucfirst($input) . ' and ' . ucfirst($rules[static::PARAM_MATCH]) . ' must be equal.';
                }
            }
        }

        if (!empty(static::$errors)) {
            throw new ValidationException('\n', implode(static::$errors)); 
        }
    }

    protected static function validateEmail($name, $value, $rules) {
        static::validateString($name, $value, $rules);

        if (!preg_match(static::EMAIL_VALIDATION_REGEX, strtolower($value))) {
            static::$errors[] = 'Invalid email address.';
        }
    }

    protected static function validatePassword($name, $value, $rules) {
        static::validateString($name, $value, $rules);

        if (!preg_match(static::PASSWORD_VALIDATION_REGEX, $value)) {
            if (strlen($value) < 20) {
                static::$errors[] = $name . ' must be at least 20 characters or contain at least three character classes.';
            }
        }
    }

    protected static function validateString($name, $value, $rules) {
        if (!is_string($value)) {
            static::$errors[] = ucfirst($name) . ' must be a string.';
            return;
        }

        if (isset($rules[static::PARAM_MAXLENGTH])) {
            if (strlen($value) > $rules[static::PARAM_MAXLENGTH]) {
                static::$errors[] = ucfirst($name) . ' must be less than ' . $rules[static::PARAM_MAXLENGTH] . ' characters.';
            }
        }

        if (isset($rules[static::PARAM_MINLENGTH])) {
            if (strlen($value) < $rules[static::PARAM_MINLENGTH]) {
                static::$errors[] = ucfirst($name) . ' must be greater than ' . $rules[static::PARAM_MINLENGTH] . ' characters.';
            }
        }
    }
}

