# PHP Perspective Comment Analyzer API

![Minimal PHP version](https://img.shields.io/packagist/php-v/stajor/perspectiveapi.svg)

PHP library for Perspective Comment Analyzer API.

## Installation

Via Composer:

```bash
composer require stajor/perspectiveapi
```
    
## Usage

#### Scoring comments: AnalyzeComment

```php
<?php

$commentsClient = new PerspectiveApi\CommentsClient('PERSPECTIVE-API-TOKEN');
$commentsClient->comment(['text' => 'What kind of idiot name is foo? Sorry, I like your name.']);
$commentsClient->languages(['en']);
$commentsClient->context(['entries' => ['text' => 'off-topic', 'type' => 'PLAIN_TEXT']]);
$commentsClient->requestedAttributes(['TOXICITY' => ['scoreType' => 'PROBABILITY', 'scoreThreshold' => 0]]);

// Analyze and get response
$response = $commentsClient->analyze();

// Print scores
print_r($response->attributeScores());
```

#### Sending feedback: SuggestCommentScore
```php
<?php

$commentsClient = new PerspectiveApi\CommentsClient('PERSPECTIVE-API-TOKEN');
$commentsClient->comment(['text' => 'What kind of idiot name is foo? Sorry, I like your name.']);
$commentsClient->languages(['en']);
$commentsClient->context(['entries' => ['text' => 'off-topic', 'type' => 'PLAIN_TEXT']]);
$commentsClient->clientToken('some-token');
$commentsClient->communityId('unit-test');
$commentsClient->attributeScores(['TOXICITY' => [
    'summaryScore' => ['value' => 0.83785176, 'type' => 'PROBABILITY'],
    'spanScores' => [['begin' => 0, 'end' => 32, 'score' => ['value' => 0.9208521, 'type' => 'PROBABILITY']]]]
]);

// Suggest Score and get response
$response = $commentsClient->suggestScore();

// Print scores
print_r($response->attributeScores());
```

## Contributing

Bug reports and pull requests are welcome on GitHub at https://github.com/Stajor/perspectiveapi. 
This project is intended to be a safe, welcoming space for collaboration, and contributors are expected to adhere to the [Contributor Covenant](http://contributor-covenant.org) code of conduct.

## License

The gem is available as open source under the terms of the [MIT License](https://opensource.org/licenses/MIT).
