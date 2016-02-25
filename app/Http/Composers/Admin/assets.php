<?php

View::composer('admin.layouts.master', function ($view) {
    $headScripts = Assets::getJavascript('top');
    $bodyScripts = Assets::getJavascript('bottom');

    $view->with('headScripts', $headScripts);
    $view->with('bodyScripts', $bodyScripts);
    $view->with('stylesheets', Assets::getStylesheets());
});
