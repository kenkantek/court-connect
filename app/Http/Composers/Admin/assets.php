<?php

View::composer('admin.layouts.master', function ($view) {
    $headScripts = Assets::getJavascript('top');
    $bodyScripts = Assets::getJavascript('bottom');
    Assets::addAppModule(['app']);
    $appModules = Assets::getAppModules();

    $groupedBodyScripts = array_merge($bodyScripts, $appModules);

    $view->with('headScripts', $headScripts);
    $view->with('bodyScripts', $groupedBodyScripts);
    $view->with('stylesheets', Assets::getStylesheets(['adminlte', 'admin', 'custom']));
});
