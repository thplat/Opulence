<?php
/**
 * Copyright (C) 2015 David Young
 * 
 * Defines a response token
 */
namespace RDev\Console\Responses\Compilers\Tokens;

class Token
{
    /** @var int The token type */
    private $type = null;
    /** @var mixed The value of the token */
    private $value = null;
    /** @var int The position of the token in the original text */
    private $position = 0;

    /**
     * @param int $type The token type
     * @param mixed $value The value of the token
     * @param int $position The position of the token in the original text
     */
    public function __construct($type, $value, $position)
    {
        $this->type = $type;
        $this->value = $value;
        $this->position = $position;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}