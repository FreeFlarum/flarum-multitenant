<?php

namespace FoF\SecureHttps\Listeners;

use Flarum\Api\Event\Serializing;
use Flarum\Api\Serializer\BasicPostSerializer;
use Flarum\Formatter\Event\Configuring;
use Flarum\Http\UrlGenerator;
use Illuminate\Contracts\Events\Dispatcher;

class ModifyContentHtml {
    private $regex = '/<img src="http:\/\/(.+?)" title="(.*?)" alt="(.*?)">/';
    public function subscribe(Dispatcher $events) {
        $events->listen(Configuring::class, [$this, 'configuring']);
        $events->listen(Serializing::class, [$this, 'serializing']);
    }

    private $subst = '<img onerror="$(this).next().empty().append(\'<blockquote style=&#92;&#39;background-color: #c0392b; color: white;&#92;&#39; class=&#92;&#39;uncited&#92;&#39;><div><p>\'+app.translator.trans(\'fof-secure-https.forum.removed\')+\' | <a href=&#92;&#39;http://$1&#92;&#39; style=&#92;&#39;color:white;&#92;&#39;target=&#92;&#39;_blank&#92;&#39;>\'+app.translator.trans(\'fof-secure-https.forum.show\')+\'</a></p></div></blockquote>\');$(this).hide();" onload="$(this).next().empty();" class="securehttps-replaced" src="https://$1" title="$2" alt="$3"><span><i class="icon fa fa-spinner fa-spin"></i> &nbsp;Loading Image</span>';

    public function serializing(Serializing $event) {
        if (!$this->isProxyEnabled() && $event->isSerializer(BasicPostSerializer::class) && isset($event->attributes['contentHtml'])) {
            $event->attributes['contentHtml'] = preg_replace($this->regex, $this->subst, $event->attributes['contentHtml']);
        }
    }

    public function configuring(Configuring $configuring) {
        if ($this->isProxyEnabled()) {
            $tag = $configuring->configurator->tags['IMG'];

            if (!isset($tag)) return;

            $tag->attributes['src']->filterChain
                ->append([$this, 'replaceUrl'])
                ->addParameterByValue(app(UrlGenerator::class)->to('api')->path('fof/secure-https/'));
        }
    }

    function replaceUrl($attrValue, $proxyUrl) {
        return $proxyUrl . urlencode($attrValue);
    }


    private function isProxyEnabled() {
        return (boolean) app('flarum.settings')->get('fof-secure-https.proxy');
    }
}