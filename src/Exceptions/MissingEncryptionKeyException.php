<?php

namespace Andrewhood125\Exceptions;

class MissingEncryptionKeyException extends \Exception
{
    public function __construct($message) {
        parent::__construct($message);
    }
}
