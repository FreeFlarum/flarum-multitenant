<?php

namespace katosdev\Signature\Validation;

use Symfony\Component\DomCrawler\Crawler;
use Flarum\Settings\SettingsRepositoryInterface;
use Illuminate\Support\Arr;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface as ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;

class ValidateSignature implements RequestHandlerInterface
{
    private $settings;
    public function __construct(SettingsRepositoryInterface $settings)
    {
        $this->settings = $settings;
    }

    public function handle(Request $request): ResponseInterface
    {
        $signature = Arr::get($request->getParsedBody(), 'signature');
        $sanitized = strip_tags($signature);
        $errorBag = [];

        $char_count = $this->settings->get('signature.maximum_char_limit', 500);
        $max_width = $this->settings->get('signature.maximum_image_width', 500);
        $max_height = $this->settings->get('signature.maximum_image_height', 500);
        $image_count = $this->settings->get('signature.maximum_image_count', 2);

        if (strlen($sanitized) > $char_count) {
            $errorBag[] = app('translator')->trans('signature.forum.errors.max_char_limit_exceed');
        }
        $crawler = (new Crawler($signature))->filter('img');
        $width = [];
        $height = [];
        $count = $crawler->count();
        if ($count > 0) {
            $crawler->each(function ($image) use (&$width, &$height) {
                $imagesize = getimagesize($image->attr('src'));
                $width[] = $imagesize[0];
                $height[] = $imagesize[1];
            });
            $highestwidth = max(array_values($width));
            $highestheight = array_sum($height);
            if ($highestwidth > $max_width) {
                $errorBag[] = app('translator')->trans('signature.forum.errors.max_image_width_exceed');
            }
            if ($highestheight > $max_height) {
                $errorBag[] = app('translator')->trans('signature.forum.errors.max_image_height_exceed');
            }
            if ($count > $image_count) {
                $errorBag[] = app('translator')->trans('signature.forum.errors.max_image_count_exceed');
            }
        }
        if (count($errorBag) > 0) {
            return new JsonResponse([
                'status' => false,
                'errors' => $errorBag,
            ]);
        } else {
            return new JsonResponse([
                'status' => true
            ]);
        }
    }
}
