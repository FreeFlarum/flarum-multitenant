<?php
namespace Malago\FancyBox\Listeners;

use Illuminate\Contracts\Events\Dispatcher;
use Flarum\Formatter\Event\Configuring;
use Flarum\Settings\SettingsRepositoryInterface;

class ConfigureTextFormatter
{
    /**
     * @var SettingsRepositoryInterface
     */
    protected $settings;

    /**
     * @param SettingsRepositoryInterface $settings
     */
    public function __construct(SettingsRepositoryInterface $settings)
    {
        $this->settings = $settings;
    }

    /**
     * Subscribes to the Flarum events
     *
     * @param Dispatcher $events
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen(Configuring::class, [$this, 'textFormatterConfigurator']);
    }

    /**
     * Configure s9e/TextFormatter
     *
     * @param Configuring $event
     */
    public function textFormatterConfigurator(Configuring $event)
    {
      // Modify the IMG BBCode
      if(array_key_exists("IMG",$event->configurator->tags)){
        $imgTag = $event->configurator->tags['IMG'];
        $attribute = $imgTag->attributes->add('fancy');
        $attribute->required = false;
        $attribute->filterChain->append('#choice')->setValues(['off']);

        $imgTag->template = preg_replace(
          '(^<[^>]++>\\K)',
          '<xsl:if test="@fancy = \'off\'"><xsl:attribute name="data-nothing-fancy"/></xsl:if>',
          $imgTag->template
        );
      }

      // Modify the URL BBCode
      if(array_key_exists("URL",$event->configurator->tags)){
        $urlTag = $event->configurator->tags['URL'];
        $attribute = $urlTag->attributes->add('fancy');
        $attribute->required = false;
        $attribute->filterChain->append('#choice')->setValues(['video', 'iframe']);

        $urlTag->template = preg_replace(
          '(^<[^>]++>\\K)',
          '<xsl:choose>
            <xsl:when test="@fancy = \'iframe\'">
              <xsl:attribute name="class">fancybox--iframe-link</xsl:attribute>
            </xsl:when>
            <xsl:otherwise>
              <xsl:if test="@fancy = \'video\'">
                <xsl:attribute name="class">fancybox--video-link</xsl:attribute>
              </xsl:if>
            </xsl:otherwise>
          </xsl:choose>',
          $urlTag->template
        );
      }
    }
}
