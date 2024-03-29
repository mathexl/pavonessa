<?php
/**
 * OAuth 2.0 Storage interface
 *
 * @package     league/oauth2-server
 * @author      Alex Bilbie <hello@alexbilbie.com>
 * @copyright   Copyright (c) Alex Bilbie
 * @license     https://mit-license.org/
 * @link        https://github.com/thephpleague/oauth2-server
 */

namespace League\OAuth2\Server\Storage;

use League\OAuth2\Server\AbstractServer;

/**
 * Storage interface
 */
interface StorageInterface
{
    /**
     * Set the server
     *
     * @param \League\OAuth2\Server\AbstractServer $server
     */
    public function setServer(AbstractServer $server);
}
