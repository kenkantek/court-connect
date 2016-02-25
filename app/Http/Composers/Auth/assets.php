<?php

View::composer('auth.layouts.master', function ($view) {
    Assets::init('auth');
    $headScripts = Assets::getJavascript('top');
    $bodyScripts = Assets::getJavascript('bottom');

    $view->with('headScripts', $headScripts);
    $view->with('bodyScripts', $bodyScripts);
    $view->with('stylesheets', Assets::getStylesheets());
});
