# Copilot Instructions for Hello Plus WordPress Theme

## Project Overview
Hello Plus is a lightweight, fast, and customizable WordPress theme built for speed and flexibility. This repository contains the theme files and development tooling for a modern WordPress theme.

## Code Quality Standards

### General Guidelines
- Write clean, readable, and maintainable code
- Follow WordPress coding standards and best practices
- Prioritize performance and accessibility
- Ensure cross-browser compatibility
- Use meaningful and descriptive names for variables, functions, and classes

### JavaScript Development
When writing JavaScript functions, always:

#### 1. Add Comprehensive JSDoc Comments
Use detailed JSDoc comments with all relevant tags and practical examples:

```javascript
/**
 * Initializes the Hello Plus theme navigation system
 * 
 * Sets up responsive navigation menu with mobile toggle functionality,
 * accessibility features, and smooth scrolling for anchor links.
 * 
 * @since 1.0.0
 * @memberof HelloPlus
 * @namespace Navigation
 * 
 * @param {Object} config - Configuration options for navigation
 * @param {string} config.menuSelector - CSS selector for menu container
 * @param {string} config.toggleSelector - CSS selector for mobile toggle button
 * @param {boolean} config.smoothScroll - Enable smooth scrolling for anchor links
 * @param {number} config.breakpoint - Mobile breakpoint in pixels
 * @param {Function} [config.onToggle] - Callback function when menu is toggled
 * 
 * @returns {Object} Navigation instance with control methods
 * @returns {Function} returns.destroy - Method to destroy navigation instance
 * @returns {Function} returns.refresh - Method to refresh navigation state
 * @returns {boolean} returns.isActive - Current active state of navigation
 * 
 * @throws {Error} Throws error if required DOM elements are not found
 * @throws {TypeError} Throws error if config is not an object
 * 
 * @fires HelloPlus#navigationInit - When navigation is initialized
 * @fires HelloPlus#menuToggle - When mobile menu is toggled
 * 
 * @example
 * // Basic navigation initialization
 * const nav = HelloPlus.initNavigation({
 *   menuSelector: '.main-navigation',
 *   toggleSelector: '.menu-toggle',
 *   smoothScroll: true,
 *   breakpoint: 768
 * });
 * 
 * @example
 * // Navigation with callback function
 * const nav = HelloPlus.initNavigation({
 *   menuSelector: '.main-navigation',
 *   toggleSelector: '.menu-toggle',
 *   smoothScroll: true,
 *   breakpoint: 768,
 *   onToggle: function(isOpen) {
 *     console.log('Menu is now:', isOpen ? 'open' : 'closed');
 *     // Update aria-expanded attribute
 *     document.querySelector('.menu-toggle')
 *       .setAttribute('aria-expanded', isOpen.toString());
 *   }
 * });
 * 
 * // Later destroy when needed
 * nav.destroy();
 * 
 * @example
 * // Advanced usage with error handling
 * try {
 *   const navigation = HelloPlus.initNavigation({
 *     menuSelector: '.primary-menu',
 *     toggleSelector: '.hamburger-btn',
 *     smoothScroll: true,
 *     breakpoint: 1024
 *   });
 *   
 *   // Refresh navigation on window resize
 *   window.addEventListener('resize', () => {
 *     navigation.refresh();
 *   });
 * } catch (error) {
 *   console.error('Navigation initialization failed:', error.message);
 * }
 */
function initNavigation(config) {
    // Input validation
    if (!config || typeof config !== 'object') {
        throw new TypeError('Configuration object is required');
    }
    
    // Required properties validation
    const requiredProps = ['menuSelector', 'toggleSelector'];
    for (const prop of requiredProps) {
        if (!config[prop] || typeof config[prop] !== 'string') {
            throw new Error(`${prop} is required and must be a string`);
        }
    }
    
    // DOM element validation
    const menuElement = document.querySelector(config.menuSelector);
    const toggleElement = document.querySelector(config.toggleSelector);
    
    if (!menuElement) {
        throw new Error(`Menu element not found: ${config.menuSelector}`);
    }
    
    if (!toggleElement) {
        throw new Error(`Toggle element not found: ${config.toggleSelector}`);
    }
    
    // Implementation here...
    return {
        destroy: () => { /* cleanup logic */ },
        refresh: () => { /* refresh logic */ },
        isActive: false
    };
}

/**
 * Manages theme customizer live preview functionality
 * 
 * @since 1.0.0
 * @memberof HelloPlus.Customizer
 * 
 * @param {string} settingId - WordPress customizer setting ID
 * @param {Object} options - Preview options
 * @param {string} options.selector - CSS selector for target elements
 * @param {string} options.property - CSS property to update
 * @param {Function} [options.transform] - Value transformation function
 * @param {string} [options.unit=''] - CSS unit to append (px, em, %, etc.)
 * 
 * @returns {void}
 * 
 * @example
 * // Update header background color in real-time
 * HelloPlus.bindCustomizerSetting('header_background_color', {
 *   selector: '.site-header',
 *   property: 'background-color'
 * });
 * 
 * @example
 * // Update font size with unit conversion
 * HelloPlus.bindCustomizerSetting('body_font_size', {
 *   selector: 'body',
 *   property: 'font-size',
 *   unit: 'px',
 *   transform: (value) => Math.max(12, parseInt(value))
 * });
 * 
 * @example
 * // Complex transformation with validation
 * HelloPlus.bindCustomizerSetting('content_width', {
 *   selector: '.content-area',
 *   property: 'max-width',
 *   unit: 'px',
 *   transform: function(value) {
 *     const numValue = parseInt(value);
 *     // Ensure value is within reasonable bounds
 *     return Math.min(Math.max(numValue, 320), 1920);
 *   }
 * });
 */
function bindCustomizerSetting(settingId, options) {
    // Implementation with comprehensive validation
}
```

#### 2. Include Input Validation
Always validate parameters at the beginning of functions:
```javascript
function processThemeOption(optionName, optionValue) {
  // Validate inputs first
  if (typeof optionName !== 'string' || !optionName.trim()) {
    throw new Error('Option name must be a non-empty string');
  }
  
  if (optionValue === null || optionValue === undefined) {
    throw new Error('Option value cannot be null or undefined');
  }
  
  // Process the validated inputs
  // ...
}
```

#### 3. Use Early Returns for Error Conditions
Avoid deep nesting by returning early on error conditions:
```javascript
function initializeThemeFeature(config) {
  if (!config) {
    return { success: false, error: 'Configuration is required' };
  }
  
  if (!config.enabled) {
    return { success: false, error: 'Feature is disabled' };
  }
  
  if (!document.getElementById(config.targetElement)) {
    return { success: false, error: 'Target element not found' };
  }
  
  // Main logic here when all conditions are met
  return { success: true };
}
```

#### 4. Use Meaningful Variable Names
```javascript
// Good: descriptive and clear
const navigationMenuItems = document.querySelectorAll('.nav-menu li');
const isUserLoggedIn = checkUserAuthStatus();
const themeCustomizationOptions = getThemeOptions();

// Avoid: unclear abbreviations
const navItems = document.querySelectorAll('.nav-menu li'); // Less clear
const isAuth = checkUserAuthStatus(); // Unclear
const opts = getThemeOptions(); // Too abbreviated
```

#### 5. Include Example Usage in Comments
Always provide at least one practical example in your function documentation:
```javascript
/**
 * Toggles the visibility of a theme element with smooth animation
 * @param {HTMLElement} element - The element to toggle
 * @param {number} duration - Animation duration in milliseconds
 * @returns {Promise} Resolves when animation completes
 * @example
 * const sidebar = document.getElementById('theme-sidebar');
 * toggleElementVisibility(sidebar, 300)
 *   .then(() => console.log('Animation complete'));
 */
```

### CSS Development
- Follow WordPress CSS coding standards
- Use meaningful class names that describe purpose, not appearance
- Prefer CSS custom properties (variables) for theme customization
- Ensure responsive design principles are applied
- Comment complex CSS rules and explain browser-specific hacks

### PHP Development (WordPress)
- Follow WordPress PHP coding standards
- Sanitize all user inputs and escape all outputs
- Use WordPress hooks and filters appropriately
- Include proper error handling and validation
- Document functions with PHPDoc comments

#### PHP Documentation Standards (PHPDoc)
Always document PHP functions with proper PHPDoc comments:

```php
/**
 * Registers and enqueues theme stylesheets and scripts
 * 
 * This function handles the proper loading of CSS and JavaScript files
 * for the Hello Plus theme, including version management and dependencies.
 * 
 * @since 1.0.0
 * @global WP_Query $wp_query The WordPress Query object
 * 
 * @param string $handle     Script/style handle for identification
 * @param array  $options    {
 *     Optional. Array of options for script/style registration.
 *     
 *     @type string $version     Version number for cache busting. Default theme version.
 *     @type array  $deps        Array of dependencies. Default empty array.
 *     @type bool   $in_footer   Whether to load script in footer. Default false.
 * }
 * @return bool True on successful registration, false on failure
 * 
 * @throws InvalidArgumentException When handle is empty or invalid
 * 
 * @example
 * // Register main theme stylesheet
 * hello_plus_enqueue_assets('main-style', array(
 *     'version' => '1.2.0',
 *     'deps' => array('wp-block-library')
 * ));
 * 
 * @example
 * // Register JavaScript with dependencies
 * hello_plus_enqueue_assets('theme-script', array(
 *     'version' => get_theme_version(),
 *     'deps' => array('jquery'),
 *     'in_footer' => true
 * ));
 */
function hello_plus_enqueue_assets($handle, $options = array()) {
    // Input validation
    if (empty($handle) || !is_string($handle)) {
        throw new InvalidArgumentException('Handle must be a non-empty string');
    }
    
    // Set defaults
    $defaults = array(
        'version' => wp_get_theme()->get('Version'),
        'deps' => array(),
        'in_footer' => false
    );
    $options = wp_parse_args($options, $defaults);
    
    // Registration logic here
    return true;
}

/**
 * Retrieves and formats theme customization options
 * 
 * @since 1.0.0
 * @uses get_theme_mod() To retrieve theme modifications
 * @uses wp_parse_args() To merge with defaults
 * 
 * @param string $option_name The name of the theme option to retrieve
 * @param mixed  $default     Default value if option doesn't exist
 * @return mixed The formatted theme option value
 * 
 * @example
 * // Get header background color with default
 * $header_bg = hello_plus_get_theme_option('header_background_color', '#ffffff');
 * 
 * @example
 * // Get typography settings
 * $font_family = hello_plus_get_theme_option('body_font_family', 'Arial, sans-serif');
 */
function hello_plus_get_theme_option($option_name, $default = '') {
    return get_theme_mod($option_name, $default);
}
```

### WordPress Theme Specific Guidelines
- Follow WordPress theme development guidelines
- Ensure accessibility standards (WCAG 2.1 AA)
- Use WordPress functions instead of native PHP when available
- Implement proper theme security measures
- Test across different WordPress versions (6.0+)

### File Organization
- Keep related functionality grouped together
- Use clear directory structure
- Separate development and production assets
- Follow WordPress theme file hierarchy

### Development Workflow
- Use the existing linting tools (stylelint for CSS)
- Test changes across different browsers
- Validate HTML and CSS
- Check for accessibility issues
- Ensure mobile responsiveness

### Performance Considerations
- Minimize HTTP requests
- Optimize images and assets
- Use efficient CSS selectors
- Implement caching strategies where appropriate
- Follow WordPress performance best practices

## Tools and Dependencies
This project uses:
- Node.js for development tooling
- Stylelint for CSS linting with WordPress standards
- Git for version control
- WordPress 6.0+ compatibility

## Function Templates
When creating new functions, use these templates as starting points:

### JavaScript Function Template

```javascript
/**
 * [Brief description of what the function does]
 * 
 * [Optional: More detailed description explaining the purpose,
 * use cases, and any important implementation details]
 * 
 * @since 1.0.0
 * @memberof HelloPlus
 * 
 * @param {type} paramName - Description of parameter
 * @param {Object} [options] - Optional configuration object
 * @param {string} options.property - Description of property
 * @param {Function} [options.callback] - Optional callback function
 * 
 * @returns {type} Description of return value
 * @returns {boolean} returns.success - Operation success status
 * @returns {string} returns.message - Status message
 * 
 * @throws {Error} Description of when errors are thrown
 * @throws {TypeError} When parameter types are invalid
 * 
 * @fires HelloPlus#eventName - When specific event occurs
 * 
 * @example
 * // Basic usage example
 * const result = functionName('example');
 * console.log(result.success); // true
 * 
 * @example
 * // Advanced usage with options
 * const result = functionName('example', {
 *   property: 'value',
 *   callback: (data) => console.log('Done:', data)
 * });
 * 
 * @example
 * // Error handling example
 * try {
 *   const result = functionName(invalidInput);
 * } catch (error) {
 *   console.error('Function failed:', error.message);
 * }
 */
function functionName(paramName, options = {}) {
    // Input validation
    if (!paramName || typeof paramName !== 'string') {
        throw new TypeError('paramName must be a non-empty string');
    }
    
    // Validate options object
    if (options && typeof options !== 'object') {
        throw new TypeError('options must be an object');
    }
    
    // Set defaults for options
    const config = {
        property: 'defaultValue',
        callback: null,
        ...options
    };
    
    // Early return for edge cases
    if (someEdgeCondition) {
        return { success: false, message: 'Edge case encountered' };
    }
    
    // Main logic with meaningful variable names
    const processedResult = processInput(paramName, config);
    
    // Execute callback if provided
    if (typeof config.callback === 'function') {
        config.callback(processedResult);
    }
    
    // Return structured result
    return {
        success: true,
        message: 'Operation completed successfully',
        data: processedResult
    };
}
```

### PHP Function Template (WordPress)

```php
<?php
/**
 * [Brief description of what the function does]
 * 
 * [Optional: More detailed description explaining the purpose,
 * WordPress integration, and any important implementation details]
 * 
 * @since 1.0.0
 * @package HelloPlus
 * @subpackage ThemeFeatures
 * 
 * @global WP_Query $wp_query The WordPress Query object
 * @global wpdb $wpdb The WordPress database abstraction object
 * 
 * @uses get_option() To retrieve WordPress options
 * @uses wp_parse_args() To merge arguments with defaults
 * @uses sanitize_text_field() To sanitize user input
 * 
 * @param string $param_name Description of parameter
 * @param array  $args {
 *     Optional. Array of arguments for function configuration.
 *     
 *     @type string $option_key    Database option key. Default 'hello_plus_default'.
 *     @type bool   $cache_result  Whether to cache the result. Default true.
 *     @type int    $cache_time    Cache duration in seconds. Default 3600.
 *     @type string $return_format Return format (array|object|string). Default 'array'.
 * }
 * 
 * @return array|WP_Error {
 *     Function result on success, WP_Error on failure.
 *     
 *     @type bool   $success Whether the operation was successful
 *     @type string $message Status message
 *     @type mixed  $data    The processed data
 * }
 * 
 * @throws InvalidArgumentException When required parameters are missing
 * 
 * @example
 * // Basic usage
 * $result = hello_plus_function_name('example');
 * if ( ! is_wp_error( $result ) && $result['success'] ) {
 *     echo 'Success: ' . $result['message'];
 * }
 * 
 * @example
 * // Advanced usage with custom arguments
 * $args = array(
 *     'option_key'    => 'custom_key',
 *     'cache_result'  => false,
 *     'return_format' => 'object'
 * );
 * $result = hello_plus_function_name('example', $args);
 * 
 * @example
 * // Error handling
 * $result = hello_plus_function_name('invalid');
 * if ( is_wp_error( $result ) ) {
 *     error_log( 'Function error: ' . $result->get_error_message() );
 *     return false;
 * }
 */
function hello_plus_function_name( $param_name, $args = array() ) {
    // Input validation
    if ( empty( $param_name ) || ! is_string( $param_name ) ) {
        return new WP_Error(
            'invalid_parameter',
            __( 'Parameter name must be a non-empty string.', 'hello-plus' )
        );
    }
    
    // Sanitize input
    $param_name = sanitize_text_field( $param_name );
    
    // Parse arguments with defaults
    $defaults = array(
        'option_key'    => 'hello_plus_default',
        'cache_result'  => true,
        'cache_time'    => 3600,
        'return_format' => 'array'
    );
    $args = wp_parse_args( $args, $defaults );
    
    // Validate parsed arguments
    $allowed_formats = array( 'array', 'object', 'string' );
    if ( ! in_array( $args['return_format'], $allowed_formats, true ) ) {
        return new WP_Error(
            'invalid_format',
            __( 'Invalid return format specified.', 'hello-plus' )
        );
    }
    
    // Early return for edge cases
    if ( some_edge_condition_check( $param_name ) ) {
        return array(
            'success' => false,
            'message' => __( 'Edge case condition met.', 'hello-plus' ),
            'data'    => null
        );
    }
    
    // Check cache if enabled
    if ( $args['cache_result'] ) {
        $cache_key = 'hello_plus_' . md5( $param_name . serialize( $args ) );
        $cached_result = get_transient( $cache_key );
        
        if ( false !== $cached_result ) {
            return $cached_result;
        }
    }
    
    // Main logic with meaningful variable names
    $processed_data = process_theme_data( $param_name, $args );
    
    // Handle processing errors
    if ( is_wp_error( $processed_data ) ) {
        return $processed_data;
    }
    
    // Prepare return data
    $return_data = array(
        'success' => true,
        'message' => __( 'Operation completed successfully.', 'hello-plus' ),
        'data'    => $processed_data
    );
    
    // Cache result if enabled
    if ( $args['cache_result'] ) {
        set_transient( $cache_key, $return_data, $args['cache_time'] );
    }
    
    // Format return data based on specified format
    switch ( $args['return_format'] ) {
        case 'object':
            return (object) $return_data;
        case 'string':
            return wp_json_encode( $return_data );
        default:
            return $return_data;
    }
}
```

Remember: Code should be self-documenting through good naming and structure, with comments explaining the "why" rather than the "what".