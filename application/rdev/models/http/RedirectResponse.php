<?php
/**
 * Copyright (C) 2014 David Young
 *
 * Defines a redirect response
 */
namespace RDev\Models\HTTP;

class RedirectResponse extends Response
{
    /** @var string The target URL */
    protected $targetURL = "";

    /**
     * @param string $targetURL The URL to redirect to
     * @param int $statusCode The HTTP status code
     * @param array $headers The headers to set
     */
    public function __construct($targetURL, $statusCode = self::HTTP_FOUND, $headers = [])
    {
        parent::__construct("", $statusCode, $headers);

        $this->setTargetURL($targetURL);
    }

    /**
     * @return string
     */
    public function getTargetURL()
    {
        return $this->targetURL;
    }

    /**
     * @param string $targetURL
     */
    public function setTargetURL($targetURL)
    {
        $this->targetURL = $targetURL;
        $this->headers->set("Location", $this->targetURL);
    }
} 