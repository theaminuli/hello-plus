# Code Quality and Standards

This document explains how to use the code quality tools set up for the Hello Plus WordPress theme.

## PHP Code Standards

This theme follows the [WordPress Coding Standards](https://developer.wordpress.org/coding-standards/) for PHP code.

### Tools Used

- **PHP_CodeSniffer (phpcs)** - Code analysis tool
- **PHP Code Beautifier and Fixer (phpcbf)** - Automatic code formatter
- **WordPress Coding Standards** - WordPress-specific coding rules
- **PHP Compatibility** - PHP version compatibility checks

### Setup

1. Install Composer dependencies:
   ```bash
   composer install
   ```

2. The coding standards are automatically configured during installation.

### Usage

#### Using Composer Scripts

**Check code for violations:**
```bash
composer run lint          # Check all PHP files
composer run check         # Check with warnings ignored
composer run check:summary # Check with summary report
```

**Fix code formatting automatically:**
```bash
composer run lint:fix      # Fix all auto-fixable violations
composer run format        # Same as lint:fix
```

**Direct phpcs usage:**
```bash
composer run phpcs         # Run phpcs directly
composer run phpcbf        # Run phpcbf directly
```

#### Using NPM Scripts

**Check PHP code:**
```bash
npm run lint:php           # Check PHP code
npm run check:php          # Check with warnings ignored
```

**Fix PHP code:**
```bash
npm run lint:php:fix       # Fix PHP code formatting
npm run format:php         # Same as lint:php:fix
```

#### Using Vendor Binaries Directly

**Check specific files:**
```bash
./vendor/bin/phpcs functions.php
./vendor/bin/phpcs index.php
```

**Fix specific files:**
```bash
./vendor/bin/phpcbf functions.php
./vendor/bin/phpcbf index.php
```

**Check all files:**
```bash
./vendor/bin/phpcs .
./vendor/bin/phpcbf .
```

### Configuration

The coding standards are configured in `phpcs.xml` which includes:

- WordPress coding standards
- PHP 7.4+ compatibility checking
- Custom theme prefix rules (`hello_plus` or `helloplus`)
- Excluded directories (vendor, node_modules, .git, .github)

### What Gets Checked

- **Code formatting** - Indentation (tabs), spacing, line endings
- **Naming conventions** - Function names, variable names, class names
- **Security practices** - Input sanitization, output escaping
- **WordPress best practices** - Hooks usage, database queries
- **PHP compatibility** - PHP 7.4+ compatibility
- **Documentation** - PHPDoc comments

### Integration with IDEs

You can configure your IDE to use the installed phpcs for real-time code checking:

- **VS Code**: Install the "PHP Sniffer & Beautifier" extension
- **PHPStorm**: Configure PHP_CodeSniffer in Settings > PHP > Quality Tools
- **Vim/Neovim**: Use plugins like ALE or Syntastic

### CI/CD Integration

You can add these commands to your CI/CD pipeline:

```bash
# Install dependencies
composer install --no-dev

# Check code quality (fails on violations)
composer run check
```

## CSS Code Standards

The theme also includes CSS linting with Stylelint and WordPress CSS coding standards.

**Check CSS:**
```bash
npm run lint:css
```

**Fix CSS:**
```bash
npm run lint:css:fix
```

## JavaScript Code Standards

The theme includes JavaScript linting with ESLint and WordPress JavaScript coding standards.

### Tools Used

- **ESLint** - JavaScript linting and code quality tool
- **WordPress ESLint Plugin** - WordPress-specific JavaScript coding rules
- **Prettier** - Code formatting integration

### Setup

1. Install NPM dependencies:
   ```bash
   npm install
   ```

2. The ESLint configuration is automatically set up in `.eslintrc.json`.

### Usage

**Check JavaScript code:**
```bash
npm run lint:js           # Check JavaScript files
```

**Fix JavaScript code:**
```bash
npm run lint:js:fix       # Fix JavaScript formatting automatically
```

**Combined linting (CSS + JS):**
```bash
npm run lint              # Check both CSS and JavaScript
npm run lint:fix          # Fix both CSS and JavaScript
npm run format            # Same as lint:fix
```

### Configuration

The JavaScript linting is configured in `.eslintrc.json` which includes:

- WordPress JavaScript coding standards
- ES6+ compatibility
- Browser and jQuery environment support
- Custom rules for indentation (tabs), quotes (single), and semicolons

### What Gets Checked

- **Code formatting** - Indentation (tabs), spacing, quotes, semicolons
- **JavaScript best practices** - Variable usage, function definitions
- **WordPress JavaScript standards** - jQuery usage, global variables
- **JSDoc comments** - Function documentation
- **ES6+ compatibility** - Modern JavaScript features

### Example JavaScript Structure

Following WordPress coding standards, JavaScript should be structured like this:

```javascript
/**
 * Theme JavaScript functionality
 *
 * @package HelloPlus
 */

/* eslint-env browser, jquery */

( function( $ ) {
	'use strict';

	/**
	 * Initializes theme functionality
	 *
	 * @return {void}
	 */
	function initTheme() {
		// Theme initialization code
	}

	// Initialize when DOM is ready
	$( document ).ready( function() {
		initTheme();
	} );
}( jQuery ) );
```

## Pre-commit Hooks

Consider setting up pre-commit hooks to automatically run code quality checks before commits:

```bash
# Add to .git/hooks/pre-commit
#!/bin/sh
composer run check
npm run lint:css
npm run lint:js
```

**Or use the combined linting command:**
```bash
# Add to .git/hooks/pre-commit
#!/bin/sh
composer run check
npm run lint
```