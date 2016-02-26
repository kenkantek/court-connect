<?php
namespace App\Components\Assets;

/**
 * Created by Sublime Text 3.
 * User: Sang Nguyen
 * Date: 22/07/2015
 * Time: 11:23 PM
 */

class Assets
{
    protected $javascript = [];
    protected $stylesheets = [];
    protected $appModules = [];
    protected $build;

    public function __construct()
    {
        $this->javascript = config('assets.admin.javascript');
        $this->stylesheets = config('assets.admin.stylesheets');

        if (config('app.env') == 'live') {
            $version = config('app.version');
        } else {
            $version = time();
        }
        $this->build = $version;
    }

    public function init($type)
    {
        $this->javascript = config('assets.' . $type . '.javascript');
        $this->stylesheets = config('assets.' . $type . '.stylesheets');

        if (config('app.env') == 'live') {
            $version = config('app.version');
        } else {
            $version = time();
        }
        $this->build = $version;
    }

    /**
     * @param array $assets
     */
    public function addJavascript($assets)
    {
        if (is_array($assets)) {
            $this->javascript = array_merge($this->javascript, $assets);
        } else {
            $this->javascript[] = $assets;
        }
    }

    /**
     * @param array $assets
     */
    public function addStylesheets($assets)
    {
        if (is_array($assets)) {
            $this->stylesheets = array_merge($this->stylesheets, $assets);
        } else {
            $this->stylesheets[] = $assets;
        }
    }

    /**
     * @param array $modules
     */
    public function addAppModule($modules)
    {
        if (is_array($modules)) {
            $this->appModules = array_merge($this->appModules, $modules);
        } else {
            $this->appModules[] = $modules;
        }
    }

    /**
     * @param array $assets
     */
    public function removeStylesheets($assets)
    {
        if (is_array($assets)) {
            foreach ($assets as $rem) {
                unset($this->stylesheets[array_search($rem, $this->stylesheets)]);
            }
        } else {
            unset($this->stylesheets[array_search($assets, $this->stylesheets)]);
        }
    }

    /**
     * @param array $assets
     */
    public function removeJavascript($assets)
    {
        if (is_array($assets)) {
            foreach ($assets as $rem) {
                unset($this->javascript[array_search($rem, $this->javascript)]);
            }
        } else {
            unset($this->javascript[array_search($assets, $this->javascript)]);
        }
    }

    /**
     *
     */
    public function getJavascript($location = null)
    {
        $scripts = [];
        if (!empty($this->javascript)) {
            // get the final scripts need for page
            $this->javascript = array_unique($this->javascript);
            foreach ($this->javascript as $js) {
                $jsConfig = 'assets.resources.javascript.' . $js;

                if (config()->has($jsConfig)) {
                    if ($location != null && config($jsConfig . '.location') !== $location) {
                        // Skip assets that don't match this location
                        continue;
                    }
                    if (config($jsConfig . '.use_cdn') && !config('assets.offline')) {
                        $src = config($jsConfig . '.src.cdn');
                        $append = null;
                        $cdn = true;
                    } else {
                        $src = config($jsConfig . '.src.local');
                        $append = '?ver=' . $this->build;
                        $cdn = false;
                    }
                    if (config($jsConfig . '.include_style')) {
                        $this->addStylesheets([$js]);
                    }
                    if (is_array($src)) {
                        foreach ($src as $s) {
                            $scripts[] = $s . $append;
                        }
                    } elseif ($cdn && $location === 'top' && config()->has($jsConfig . '.fallback')) {
                        // Fallback to local script if CDN fails
                        $fallback = config($jsConfig . '.fallback');
                        $scripts[] = [
                            'url' => $src,
                            'fallback' => $fallback,
                            'fallbackURL' => config($jsConfig . '.src.local'),
                        ];
                    } else {
                        $scripts[] = $src . $append;
                    }
                    if (file_exists(public_path() . '/resources/admin/js/conf/' . $js . '.js')) {
                        $scripts[] = '/resources/admin/js/conf/' .
                        $js . '.js?ver=' . $this->build;
                    }
                }
            }
        }

        return $scripts;
    }

    /**
     *
     */
    public function getStylesheets($lastModules = [])
    {
        $stylesheets = [];
        if (!empty($this->stylesheets)) {
            if (!empty($lastModules)) {
                $this->stylesheets = array_merge($this->stylesheets, $lastModules);
            }
            // get the final scripts need for page
            $this->stylesheets = array_unique($this->stylesheets);
            foreach ($this->stylesheets as $style) {
                if (config()->has('assets.resources.stylesheets.' . $style)) {
                    if (config('assets.resources.stylesheets.' . $style . '.use_cdn') && !config('assets.offline')) {
                        $src = config('assets.resources.stylesheets.' . $style . '.src.cdn');
                        $append = null;
                    } else {
                        $src = config('assets.resources.stylesheets.' . $style . '.src.local');
                        $append = '?ver=' . $this->build;
                    }
                    if (is_array($src)) {
                        foreach ($src as $s) {
                            $stylesheets[] = $s . $append;
                        }
                    } else {
                        $stylesheets[] = $src . $append;
                    }
                }
            }
        }

        return $stylesheets;
    }

    /**
     * @return array
     */
    public function getAppModules()
    {
        $modules = [];
        if (!empty($this->appModules)) {
            // get the final scripts need for page
            $this->appModules = array_unique($this->appModules);
            foreach ($this->appModules as $module) {
                if (($module = $this->getAppModule($module)) !== null) {
                    $modules[] = $module;
                }
            }
        }

        return $modules;
    }

    public function getAppModule($module)
    {
        return $this->getModule($module, 'app');
    }

    protected function getModule($module, $type)
    {
        $pathPrefix = config('assets.' . $type . '_module_path') . $module;

        if (file_exists($pathPrefix . '.min.js')) {
            $file = $module . '.min.js';
        } elseif (file_exists($pathPrefix . '.js')) {
            $file = $module . '.js';
        } else {
            $file = null;
        }

        if ($file) {
            return '/resources/admin/js/' . $type . '_modules/' . $file . '?ver=' . $this->build;
        } else {
            return null;
        }
    }

}
