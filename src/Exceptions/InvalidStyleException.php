<?php
namespace Docit\Support\Exceptions;

/**
 * This is the InvalidStyleException used in Docit\Support\Vendor\ConsoleColor and Docit\Support\Command.
 *
 * @package        Docit\Support
 * @author         Sebwite Dev Team
 * @copyright      Copyright (c) 2015, Sebwite
 * @license        https://tldrlegal.com/license/mit-license MIT License
 */
class InvalidStyleException extends \Exception
{
    /**
     * @param string $styleName
     */
    public function __construct($styleName)
    {
        parent::__construct("Invalid style $styleName.");
    }
}
