<?php
// PHPStorm Meta file - helps IDE understand Laravel facades and bindings

namespace PHPSTORM_META {

    override(\Illuminate\Support\Facades\Auth::class, map([
        '' => \Illuminate\Auth\AuthManager::class,
    ]));

    override(\auth(), map([
        '' => \Illuminate\Auth\AuthManager::class,
    ]));

}
