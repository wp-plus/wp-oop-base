<?php

namespace WpPlus\WpOopBase\Registrable;

/**
 * @internal
 */
interface RegistrableInterface
{
    public function register(): static;

    public function unregister(): static;
}
