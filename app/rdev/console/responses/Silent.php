<?php
/**
 * Copyright (C) 2015 David Young
 *
 * Defines the silent response, which does not write anything
 */
namespace RDev\Console\Responses;

class Silent extends Response
{
    /**
     * {@inheritdoc}
     */
    protected function doWrite($message, $includeNewLine)
    {
        // Don't do anything
    }
}