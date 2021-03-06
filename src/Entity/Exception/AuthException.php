<?php

namespace Webit\WFirmaSDK\Entity\Exception;

use Webit\WFirmaSDK\Entity\Request;
use Webit\WFirmaSDK\Entity\Response;

class AuthException extends ApiException
{
    /**
     * @inheritdoc
     */
    protected static function message(Request $request, Response $response = null)
    {
        return 'This action requires credentials to be passed or given credentials are invalid.';
    }
}
