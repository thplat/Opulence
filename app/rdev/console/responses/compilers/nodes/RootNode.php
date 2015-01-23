<?php
/**
 * Copyright (C) 2015 David Young
 *
 * Defines a root node
 */
namespace RDev\Console\Responses\Compilers\Nodes;

class RootNode extends Node
{
    public function __construct()
    {
        parent::__construct(null);
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isTag()
    {
        return false;
    }
}