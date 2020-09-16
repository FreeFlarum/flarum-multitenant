<?php namespace PerspectiveApi;

class CommentsResponse {
    protected $response;

    public function __construct(array $response) {
        $this->response = $response;
    }

    public function attributeScores(): ?array {
        return $this->response['attributeScores'] ?? null;
    }

    public function languages(): ?array {
        return $this->response['languages'] ?? null;
    }

    public function clientToken(): ?string {
        return $this->response['clientToken'] ?? null;
    }

    public function detectedLanguages(): ?array {
        return $this->response['detectedLanguages'] ?? null;
    }
}
