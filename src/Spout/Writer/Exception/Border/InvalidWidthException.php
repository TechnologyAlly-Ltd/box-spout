<?php

namespace TA\Spout\Writer\Exception\Border;

use TA\Spout\Common\Entity\Style\BorderPart;
use TA\Spout\Writer\Exception\WriterException;

class InvalidWidthException extends WriterException
{
    public function __construct($name)
    {
        $msg = '%s is not a valid width identifier for a border. Valid identifiers are: %s.';

        parent::__construct(\sprintf($msg, $name, \implode(',', BorderPart::getAllowedWidths())));
    }
}
