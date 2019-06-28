<?php

namespace Webit\WFirmaSDK\Entity\Infrastructure\Buzz;

use Buzz\Middleware\MiddlewareInterface;
use Nyholm\Psr7\Uri;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class BasicOauthMiddleware implements MiddlewareInterface
{
    /** @var string */
    private $oauthConsumerKey;

    /** @var string */
    private $oauthToken;

    /** @var string */
    private $oauthSignature;

    /** @var string */
    private $oauthSignatureMethod;

    /**
     * @param string $oauthConsumerKey
     * @param string $oauthToken
     * @param string $oauthSignature
     * @param string $oauthSignatureMethod
     */
    public function __construct($oauthConsumerKey, $oauthToken, $oauthSignature, $oauthSignatureMethod)
    {
        $this->oauthConsumerKey = $oauthConsumerKey;
        $this->oauthToken = $oauthToken;
        $this->oauthSignature = $oauthSignature;
        $this->oauthSignatureMethod = $oauthSignatureMethod;
    }

    public function handleRequest(RequestInterface $request, callable $next)
    {
        $timestamp = time();
	$nonce = md5(mt_rand() . 'lerning' . $timestamp);
        $oauthVal = "OAuth oauth_consumer_key=\"$this->oauthConsumerKey\",oauth_token=\"$this->oauthToken\",oauth_signature_method=\"$this->oauthSignatureMethod\",oauth_timestamp=\"$timestamp\",oauth_nonce=\"$nonce\",oauth_signature=\"$this->oauthSignature\"";

        $request = $request->withAddedHeader('Authorization', $oauthVal);

        return $next($request);
    }

    public function handleResponse(RequestInterface $request, ResponseInterface $response, callable $next)
    {
        return $next($request, $response);
    }
}