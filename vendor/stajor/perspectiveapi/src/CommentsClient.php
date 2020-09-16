<?php namespace PerspectiveApi;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class CommentsClient {
    const API_URL = 'https://commentanalyzer.googleapis.com/v1alpha1';

    protected $token;
    protected $comment;
    protected $languages;
    protected $context;
    protected $requestedAttributes;
    protected $spanAnnotations;
    protected $doNotStore;
    protected $clientToken;
    protected $sessionId;
    protected $attributeScores;
    protected $communityId;

    public function __construct(string $token) {
        $this->token = $token;
    }

    /**
     * Make an Analyze Comment request
     *
     * @return CommentsResponse
     * @throws CommentsException
     */
    public function analyze(): CommentsResponse {
        $fields = [
            'comment', 'languages', 'requestedAttributes', 'context', 'spanAnnotations', 'doNotStore', 'clientToken',
            'sessionId'
        ];

        return $this->request('analyze', $fields);
    }

    /**
     * Sending feedback: SuggestCommentScore
     *
     * @return CommentsResponse
     * @throws CommentsException
     */
    public function suggestScore(): CommentsResponse {
        $fields = ['comment', 'context', 'attributeScores', 'languages', 'communityId', 'clientToken'];

        return $this->request('suggestscore', $fields);
    }

    /**
     * The text to score. This is assumed to be utf8 raw text of the text to be checked.
     *
     * @example ['text' => string, 'type' => string]
     * @param array $comment
     */
    public function comment(array $comment): void {
        $this->comment = $comment;
    }

    /**
     * A list of objects providing the context for comment
     *
     * @example ['entries': [{'text': string, 'type': string}]
     * @param array $context
     */
    public function context(array $context): void {
        $this->context = $context;
    }

    /**
     * A list of ISO 631-1 two-letter language codes specifying the language(s) that comment is in
     *
     * @example [string]
     * @param array $languages
     */
    public function languages(array $languages): void {
        $this->languages = $languages;
    }

    /**
     * A map from model's attribute name to a configuration object
     *
     * @example [string: {'scoreType': string, 'scoreThreshold': float},]
     * @param array $requestedAttributes
     */
    public function requestedAttributes(array $requestedAttributes): void {
        $this->requestedAttributes = $requestedAttributes;
    }

    /**
     * A boolean value that indicates if the request should return spans that describe the scores for each part of the
     * text
     * @example bool
     * @param bool $spanAnnotations
     */
    public function spanAnnotations(bool $spanAnnotations): void {
        $this->spanAnnotations = $spanAnnotations;
    }

    /**
     * Whether the API is permitted to store comment and context from this request
     *
     * @example bool
     * @param bool $doNotStore
     */
    public function doNotStore(bool $doNotStore): void {
        $this->doNotStore = $doNotStore;
    }

    /**
     * An opaque token that is echoed back in the response
     *
     * @example string
     * @param string $clientToken
     */
    public function clientToken(string $clientToken) {
        $this->clientToken = $clientToken;
    }

    /**
     * An opaque session id
     *
     * @example string
     * @param string $sessionId
     */
    public function sessionId(string $sessionId) {
        $this->sessionId = $sessionId;
    }

    /**
     * A map from model attribute name to per-attribute score objects
     *
     * @example [string: {
     *  'summaryScore': {'value': float,'type': string},
     *  'spanScores': [{'begin': int,'end': int,'score': {'value': float,'type': string}}]
     * }]
     * @param array $attributeScores
     */
    public function attributeScores(array $attributeScores) {
        $this->attributeScores = $attributeScores;
    }

    /**
     * Opaque identifier associating this score suggestion with a particular community
     *
     * @example string
     * @param string $communityId
     */
    public function communityId(string $communityId) {
        $this->communityId = $communityId;
    }

    /**
     * Send request to API
     *
     * @param string $method
     * @param array $fields
     * @return CommentsResponse
     * @throws CommentsException
     */
    protected function request(string $method, array $fields): CommentsResponse {
        $data   = [];
        $client = new Client(['defaults' => [
            'headers'  => ['content-type' => 'application/json', 'Accept' => 'application/json'],
        ]]);

        foreach ($fields AS $field) {
            if (isset($this->{$field})) {
                $data[$field] = $this->{$field};
            }
        }

        try {
            $response = $client->post(self::API_URL."/comments:{$method}?key={$this->token}", ['json' => $data]);
        } catch (ClientException $e) {
            $error = json_decode($e->getResponse()->getBody(), true);

            if (isset($error['error'])) {
                throw new CommentsException($error['error']['message'], $error['error']['code']);
            } else {
                throw $e;
            }
        }

        $result = json_decode($response->getBody(), true);

        return new CommentsResponse($result);
    }
}
