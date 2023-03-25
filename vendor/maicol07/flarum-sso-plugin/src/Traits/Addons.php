<?php


namespace Maicol07\SSO\Traits;

use Hooks\Hooks;

trait Addons
{
    /** @var Hooks|null */
    private $hooks;

    /** @var array List of loaded addons */
    private $addons = [];

    /**
     * Load an addon to the plugin
     *
     * @param string $addon Class name to add as addon
     * @return int
     */
    public function loadAddon(string $addon): int
    {
        $this->addons[] = new $addon($this->hooks, $this);
        return array_key_last($this->addons);
    }

    /**
     * Unloads an addon from the plugin
     *
     * @param string $addon Addon class name to remove
     * @return $this
     */
    public function unloadAddon(string $addon): self
    {
        $key = array_search($addon, $this->addons, true);
        $hook = $this->addons[$key];
        $hook->unload();
        unset($hook);
        return $this;
    }

    /**
     * Set addon properties
     *
     * @param string $addon
     * @param array $attributes
     * @return $this
     */
    public function setAddonProperties(string $addon, array $attributes): self
    {
        $hook = $this->addons[array_search($addon, $this->addons, true)];
        foreach ($attributes as $key => $value) {
            $hook->$key = $value;
        }
        return $this;
    }

    /**
     * Check if addon is loaded
     *
     * @param string $addon
     * @return bool
     */
    public function isAddonLoaded(string $addon): bool
    {
        return in_array($addon, $this->addons, true);
    }

    /**
     * A simple proxy to Hook do_action function
     *
     * @param string $tag
     * @return int|null
     */
    public function action_hook(string $tag): ?int
    {
        $args = func_get_args();
        array_shift($args);

        if (!$this->hooks->has_action($tag)) {
            return -1;
        }
        $this->hooks->do_action($tag, $args);
        return null;
    }

    /**
     * A simple proxy to Hook apply_filters function
     *
     * @param string $tag
     * @param $value
     *
     * @return mixed
     *
     * @noinspection MissingReturnTypeInspection
     * @noinspection MissingParameterTypeDeclarationInspection
     */
    public function filter_hook(string $tag, $value)
    {
        if (!$this->hooks->has_filter($tag)) {
            return -1;
        }
        return $this->hooks->apply_filters($tag, $value);
    }

    /**
     * Inits addons
     */
    private function initAddons(): void
    {
        $this->hooks = new Hooks();
        foreach ($this->addons as $key => $addon) {
            unset($this->addons[$key]);
            $this->addons[$key] = new $addon($this->hooks, $this);
        }
    }
}
