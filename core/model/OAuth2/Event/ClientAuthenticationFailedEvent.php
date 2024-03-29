<?php
/**
 * OAuth 2.0 client authentication failed event
 *
 * @package     league/oauth2-server
 * @author      Alex Bilbie <hello@alexbilbie.com>
 * @copyright   Copyright (c) Alex Bilbie
 * @license     https://mit-license.org/
 * @link        https://github.com/thephpleague/oauth2-server
 */

namespace League\OAuth2\Server\Event;

use League\Event\AbstractEvent;
use Symfony\Component\HttpFoundation\Request;

class ClientAuthenticationFailedEvent extends AbstractEvent
{
    /**
     * Request
     *
     * @var \Symfony\Component\HttpFoundation\Request
     */
    private $request;

    /**
     * Init the event with a request
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * The name of the event
     *
     * @return string
     */
    public function getName()
    {
        return 'error.auth.client';
    }

    /**
     * Return request
     *
     * @return \Symfony\Component\HttpFoundation\Request
     */
    public function getRequest()
    {
        return $this->request;
    }
}
