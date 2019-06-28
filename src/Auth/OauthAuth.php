<?php

namespace Webit\WFirmaSDK\Auth;

final class OauthAuth
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
     * @param null $companyId
     */
    public function __construct($oauthConsumerKey, $oauthToken, $oauthSignature, $oauthSignatureMethod = 'PLAINTEXT', $companyId = null)
    {
        $this->oauthConsumerKey = $oauthConsumerKey;
        $this->oauthToken = $oauthToken;
        $this->oauthSignature = $oauthSignature;
        $this->oauthSignatureMethod = $oauthSignatureMethod;
        $this->companyId = $companyId;
    }

    /**
     * @return string
     */
    public function oauthConsumerKey()
    {
        return $this->oauthConsumerKey;
    }

    /**
     * @return string
     */
    public function oauthToken()
    {
        return $this->oauthToken;
    }

    /**
     * @return string
     */
    public function oauthSignature()
    {
        return $this->oauthSignature;
    }

    /**
     * @return string
     */
    public function oauthSignatureMethod()
    {
        return $this->oauthSignatureMethod;
    }

    /**
     * @return int
     */
    public function companyId()
    {
        return $this->companyId;
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return ! ($this->oauthConsumerKey || $this->oauthToken || $this->oauthSignature || $this->oauthSignatureMethod);
    }
}