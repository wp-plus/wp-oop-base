<?php

namespace WpPlus\WpOopBase\Common\Registrable;

/**
 * @internal
 */
interface RegistrableInterface
{
    public function register(): static;

    public function unregister(): static;
}
