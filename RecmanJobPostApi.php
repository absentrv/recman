<?php

/**
 * This class works with Recman api.
 * Link to full api documentation: https://developers.recman.no/documentation
 * 
 * It is a simple realization to get data via Recman api
 * 
 * @author Serhii Filoniuk
 */
class RecmanJobPostApi
{

    /**
     * @const Api endpoint
     */
    const API_URL = 'https://api.recman.no/v2/get/';

    /**
     * @var Api Key
     */
    private $apiKey;

    /**
     * @var Scope of api call
     */
    private $scope;

    /**
     * @var Query params
     */
    private $queryParams = [];

    /**
     * @var Response of api call
     */
    private $result;

    /**
     * Constructor.    
     *
     * @param string $apiKey Api key for future api request
     * @param string $scope Scope for api key, optional, can be setted later
     */
    public function __construct(string $apiKey, string $scope = '')
    {
        $this->apiKey = $apiKey;
        $this->scope = $scope;
    }

    /**
     * Set the Scope
     *
     * @param string Scope for api call
     */
    public function setScope(string $scope)
    {
        $this->scope = $scope;
    }

    /**
     * Get the Scope
     *
     * @return string Current scope of api call
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * Get last result
     *
     * @return stdClass Object Last api call result
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * Main method.
     * It prepare query params and url for api call and made the request
     * 
     * @param string $fields string of fields divided by comma, which will be returned for each JobPost
     * @return stdClass Object Result of apicall
     */
    public function getJobPosts(string $fields)
    {
        $queryUrlString = $this->prepareQueryUrl($fields);
        /**
         * NOTE: There is able to use a cURL, but `file_get_contents` function
         * is the simplest way to do api call
         */
        
        $this->result = json_decode(file_get_contents($queryUrlString));
        return $this->result;
    }

    /**
     * Prepare url for api call
     * 
     * @param string $fields string of fields divided by comma, which will be returned for each JobPost
     * @return string Prepeared Url with query params
     */
    private function prepareQueryUrl(string $fields)
    {
        $this->queryParams['key'] = $this->apiKey;
        $this->queryParams['scope'] = $this->scope;
        $this->queryParams['fields'] = $fields;
        return self::API_URL . '?' . http_build_query($this->queryParams);
    }
}
