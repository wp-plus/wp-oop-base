# WP OOP Base

An opinionated object-oriented base library for WordPress plugin and theme development, providing a structured foundation for building maintainable WordPress extensions.

## Overview

WP OOP Base offers a collection of abstract classes and interfaces that promote clean, object-oriented architecture in WordPress development. It provides standardized patterns for common WordPress functionality including plugins, hooks, shortcodes, custom post types, and taxonomies.

## Features

- **Plugin Architecture**: Singleton-based plugin classes with extensible sub-plugin support
- **Hook Management**: Object-oriented wrapper for WordPress actions and filters
- **Shortcode Framework**: Structured approach to shortcode development with attribute validation
- **Custom Post Types & Taxonomies**: Abstract classes for registering custom content types
- **Helper Utilities**: Common WordPress development utilities
- **Clean Architecture**: Structured patterns for maintainable code organization
- **PSR-4 Autoloading**: Modern PHP autoloading standards

## Requirements

- PHP 8.0 or higher
- WordPress 6.5 or higher (for development)

## Installation

### Via Composer

```bash
composer require wp-plus/wp-oop-base
```

### Manual Installation

1. Download the library
2. Place it in your `wp-content/plugins/` directory
3. Optionally, move `wp-oop-base.php` to `wp-content/mu-plugins/` for must-use plugin functionality

## Quick Start

### Creating a Plugin

```php
<?php

use WpPlus\WpOopBase\Plugin\AbstractPlugin;

class MyPlugin extends AbstractPlugin
{
    protected function main(): void
    {
        // Initialize your plugin hooks and functionality here
        add_action('init', [$this, 'initialize']);
    }
    
    public function initialize(): void
    {
        // Plugin initialization logic
    }
}

// Initialize the plugin
MyPlugin::runInstance();
// or 
// MyPlugin::getInstance()->run();
```

### Creating a Hook

```php
<?php

use WpPlus\WpOopBase\Hook\AbstractHook;

class MyCustomHook extends AbstractHook
{
    public function getName(): string
    {
        return 'wp_head';
    }
    
    public function getPriority(): int
    {
        return 20;
    }
    
    protected function callback(...$args): mixed
    {
        echo '<meta name="custom" content="my-plugin">';
        return null;
    }
}

// Register the hook
MyCustomHook::registerInstance();
```

### Creating a Shortcode

```php
<?php

use WpPlus\WpOopBase\Shortcode\AbstractShortcode;

class MyShortcode extends AbstractShortcode
{
    public function getTag(): string
    {
        return 'my_shortcode';
    }
    
    protected function getSupportedAttributes(): array
    {
        return [
            'title' => 'Default Title',
            'color' => 'blue'
        ];
    }
    
    protected function doShortcode(array $attributes, string|null $content): string
    {
        return sprintf(
            '<div style="color: %s"><h3>%s</h3>%s</div>',
            esc_attr($attributes['color']),
            esc_html($attributes['title']),
            $content ? wpautop($content) : ''
        );
    }
}

// Register the shortcode
(new MyShortcode())->register();
```

### Creating a Custom Post Type

```php
<?php

use WpPlus\WpOopBase\Custom\PostType\AbstractCustomPostType;

class ProductPostType extends AbstractCustomPostType
{
    public static function getPostType(): string
    {
        return 'product';
    }
    
    protected function getConfig(): array
    {
        return [
            'labels' => [
                'name' => 'Products',
                'singular_name' => 'Product'
            ],
            'public' => true,
            'has_archive' => true,
            'supports' => ['title', 'editor', 'thumbnail']
        ];
    }
}

// Register the post type
ProductPostType::registerInstance();
```

## Architecture

### Core Components

#### Plugin System
- `AbstractPlugin`: Base class for singleton plugin instances
- `AbstractExtensiblePlugin`: Plugin class that can contain sub-plugins
- `PluginsContainerTrait`: Manages collections of sub-plugins

#### Hook System
- `AbstractHook`: Base class for WordPress actions and filters
- `AbstractActivationHook`: Specialized hooks for plugin activation
- `AbstractMultiHook`: Container of multiple hooks with hook-like interface

#### Registration System
- `RegistrableInterface`: Contract for registerable components
- `AbstractRegistrable`: Base implementation for registerable components

#### Content Types
- `AbstractCustomPostType`: Framework for custom post types
- `AbstractCustomTaxonomy`: Framework for custom taxonomies

#### Other
- `AbstractShortcode`: Structured shortcode development with attribute validation

### Design Patterns

#### Singleton Pattern
All plugin classes use the singleton pattern to ensure single instances:

```php
$plugin = MyPlugin::getInstance();
```

#### Convenient Static Methods
The library provides convenient static methods for common operations:

```php
// Register components directly
MyHook::registerInstance();

// Run plugins directly
MyPlugin::runInstance();
```

#### Registration Pattern
Components implement a consistent registration/unregistration pattern:

```php
$component->register();   // Register with WordPress
$component->unregister(); // Remove from WordPress
```

## Helper Classes

### DateTime Helper
Utilities for WordPress-aware date/time formatting:

```php
use WpPlus\WpOopBase\Helper\DateTime;

// Format timestamp with WordPress timezone
$formatted = DateTime::format(time(), 'Y-m-d H:i:s');

// MySQL datetime format
$mysql = DateTime::format(time(), 'mysql');
```

### Post Helper
Utilities for post operations:

```php
use WpPlus\WpOopBase\Helper\Post;

// Get post by slug
$post = Post::getPostBySlug('my-post-slug', 'product');

// Get post ID by slug
$id = Post::getPostIdBySlug('my-post-slug', 'product');
```

### Database Access Trait
Convenient access to the WordPress database object:

```php
use WpPlus\WpOopBase\Support\WpDbTrait;

class MyClass
{
    use WpDbTrait;

    public function getSomething(): array
    {
        return $this->wpdb()->get_results("SELECT * FROM ...");
    }
}
```

## Advanced Usage

### Extensible Plugins

Create plugins that can contain other plugins:

```php
<?php

use WpPlus\WpOopBase\Plugin\AbstractExtensiblePlugin;

class MainPlugin extends AbstractExtensiblePlugin
{
    protected function main(): void
    {
        // Add sub-plugins
        $this->addPlugin(SubPlugin1::class);
        $this->addPlugin(new SubPlugin2());
    }
}

MainPlugin::getInstance()->run(); // Runs main plugin and all sub-plugins
```

### Multi-Hooks

Register multiple related hooks together:

```php
<?php

use WpPlus\WpOopBase\Hook\AbstractHook;
use WpPlus\WpOopBase\Hook\AbstractMultiHook;

class PostStatusFunctionality extends AbstractMultiHook
{
    public function __construct(AbstractHook ...$hooks)
    {
        // Hook for when post is published
        $hooks[] = new class extends AbstractHook {
            public function getName(): string
            {
                return 'publish_post';
            }
            
            protected function callback(...$args): mixed
            {
                // Handle post publication
                error_log('Post published: ' . $args[0]->ID);
                return null;
            }
        };
        
        // Hook for when post is trashed
        $hooks[] = new class extends AbstractHook {
            public function getName(): string
            {
                return 'wp_trash_post';
            }
            
            protected function callback(...$args): mixed
            {
                // Handle post deletion
                error_log('Post trashed: ' . $args[0]);
                return null;
            }
        };
        
        parent::__construct(...$hooks);
    }
}

// Register all related hooks at once
(new PostStatusFunctionality())->register();
```

## Best Practices

1. **Use Dependency Injection**: Set dependencies via setters in plugin constructors
2. **Follow WordPress Coding Standards**: Maintain consistency with WordPress conventions
3. **Implement Proper Error Handling**: Use exceptions for configuration errors
4. **Validate Input**: Always validate and sanitize user input in shortcodes and hooks
5. **Use Static Methods Judiciously**: Static convenience methods create new instances each time they're called

## Contributing

Contributions are welcome! Please ensure your code follows PSR-4 autoloading standards and includes appropriate documentation.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
