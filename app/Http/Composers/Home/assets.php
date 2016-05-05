<?php

View::composer('home.layouts.master', function ($view) {
    Assets::init('home');
    $headScripts = Assets::getJavascript('top');
    $bodyScripts = Assets::getJavascript('bottom');

    $view->with('headScripts', $headScripts);
    $view->with('bodyScripts', $bodyScripts);
    $view->with('stylesheets', Assets::getStylesheets(['home']));
});
