# Code Quality and Standards

This document explains how to use the code quality tools set up for the Hello Plus WordPress theme.

**Project Information:**
- **Package**: `theaminuli/hello-plus`
- **Author**: Aminul Islam (hello@theaminul.com)
- **License**: GPL-3.0-or-later
- **PHP Version**: >=7.4

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

2. The coding standards are automatically configured during installation via the `dealerdirect/phpcodesniffer-composer-installer` plugin.

3. If needed, manually configure coding standards paths:
   ```bash
   composer run install-codestandards
   ```

### Usage

#### Using Composer Scripts

**Check code for violations:**
```bash
composer run lint          # Check all PHP files
composer run check         # Check with warnings ignored
composer run check:summary # Check with summary report only
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

**Configure coding standards (if needed):**
```bash
composer run install-codestandards  # Set up coding standards paths
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
- Excluded directories (vendor, node_modules, .git, .github, build)

The `composer.json` also includes:

- **Exclude patterns**: Automatically excludes development files from distribution
- **Archive settings**: When creating distribution packages, excludes `/node_modules`, `/vendor`, and `/src`
- **Auto-installer**: Automatically configures coding standards paths during `composer install`

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

### Distribution and Packaging

The theme is configured for clean distribution:

**Excluded from development:**
- `/node_modules` - NPM dependencies
- `/vendor` - Composer dependencies 
- `/tests` - Test files
- `/.git` - Git repository files
- `/.github` - GitHub workflow files
- `/.vscode` - VS Code settings
- `/build` - Build artifacts

**Excluded from distribution archive:**
- `/node_modules` - Not needed in production
- `/vendor` - Composer dependencies (install separately)
- `/src` - Source files (only built files needed)

**Creating a distribution package:**
```bash
# Install production dependencies only
composer install --no-dev --optimize-autoloader

# Build production assets
npm run build

# The theme is now ready for distribution
# (development files are automatically excluded)
```

## CSS Code Standards

The theme includes CSS linting with Stylelint and WordPress CSS coding standards using `@wordpress/scripts`.

### Tools Used

- **Stylelint** - CSS linting and code quality tool
- **WordPress Stylelint Config** - WordPress-specific CSS coding rules
- **@wordpress/scripts** - WordPress development toolkit

### Usage

**Check CSS:**
```bash
npm run lint:css           # Check CSS files using wp-scripts lint-style
```

**Note:** CSS auto-fixing is handled by the general format command:
```bash
npm run format             # Format all files (CSS, JS) using wp-scripts
```

## JavaScript Code Standards

The theme includes JavaScript linting with ESLint and WordPress JavaScript coding standards.

### Tools Used

- **ESLint** - JavaScript linting and code quality tool
- **WordPress ESLint Plugin** - WordPress-specific JavaScript coding rules
- **@wordpress/scripts** - Complete WordPress development toolkit
- **Webpack** - Module bundler for modern JavaScript development (via wp-scripts)

### Approach

This theme uses modern WordPress development practices:

- **Frontend**: WordPress Interactivity API (WordPress 6.5+) with vanilla JavaScript fallback
- **Admin/Backend**: React components for WordPress admin interfaces
- **No jQuery dependency** - Uses native browser APIs and WordPress Interactivity API
- **Build Process**: Webpack for bundling and optimizing JavaScript/CSS assets

The Interactivity API is the recommended approach for frontend interactivity in modern WordPress themes. For more information, see the [WordPress Interactivity API documentation](https://developer.wordpress.org/block-editor/reference-guides/interactivity-api/).


### Setup

1. Install NPM dependencies:
   ```bash
   npm install
   ```

2. Build assets for production:
   ```bash
   npm run build
   ```

3. For development:
   ```bash
   npm run dev     # Development build with file watching and hot reload
   ```

### Usage

**Build assets:**
```bash
npm run build             # Production build (minified, optimized)
npm run dev               # Development build with watch mode and hot reload
```

**Check JavaScript code:**
```bash
npm run lint:js           # Check JavaScript files using wp-scripts lint-js
```

**Check CSS code:**
```bash
npm run lint:css          # Check CSS files using wp-scripts lint-style
```

**Format code:**
```bash
npm run format            # Format all files (JS, CSS) using wp-scripts format
```

**Update packages:**
```bash
npm run packages-update   # Update WordPress packages to latest versions
```

**Create plugin zip (if needed):**
```bash
npm run plugin-zip        # Create distributable zip file
```

### Configuration

The JavaScript and CSS linting is configured through:

- **`.eslintrc.json`** - ESLint configuration with WordPress standards
- **`@wordpress/scripts`** - Provides default WordPress configurations
- **`webpack.config.js`** (auto-generated) - Build configuration
- **`.stylelintrc.json`** (if present) - Custom Stylelint rules

Default configurations include:
- WordPress JavaScript coding standards
- ES6+ compatibility with Babel transpilation
- Browser environment support
- WordPress Interactivity API support
- Custom rules for indentation (tabs), quotes (single), and semicolons
- PostCSS processing for CSS

### What Gets Checked

**JavaScript:**
- **Code formatting** - Indentation (tabs), spacing, quotes, semicolons
- **JavaScript best practices** - Variable usage, function definitions
- **WordPress JavaScript standards** - Interactivity API usage, global variables
- **JSDoc comments** - Function documentation
- **ES6+ compatibility** - Modern JavaScript features
- **React/JSX** (if used) - Component structure and hooks

**CSS:**
- **Code formatting** - Indentation, spacing, property order
- **WordPress CSS standards** - Naming conventions, best practices
- **Modern CSS features** - Custom properties, logical properties
- **Browser compatibility** - Vendor prefixes, fallbacks

**Build Process:**
- **Asset optimization** - Minification, tree shaking
- **Dependency management** - Automatic WordPress dependency injection
- **Source maps** - For debugging in development
- **Hot reload** - Live updates during development

**Important**: Edit files in the `src/` directory. Built files in `build/` are automatically generated.

### Example JavaScript Structure

Following WordPress coding standards with Interactivity API, JavaScript should be structured like this:

```javascript
/**
 * Theme JavaScript functionality
 *
 * @package HelloPlus
 */

/* eslint-env browser */

document.addEventListener('DOMContentLoaded', function () {
	'use strict';

	/**
	 * Initializes theme functionality
	 *
	 * @return {void}
	 */
	function initTheme() {
		// Theme initialization code
	}

	/**
	 * Example WordPress Interactivity API usage
	 *
	 * @return {void}
	 */
	function initInteractivityFeatures() {
		if (typeof wp !== 'undefined' && wp.interactivity) {
			// Use Interactivity API for modern WordPress (6.5+)
			wp.interactivity.state({
				theme: {
					isMenuOpen: false
				}
			});
		} else {
			// Fallback to vanilla JavaScript
			const menuToggle = document.querySelector('.menu-toggle');
			// Handle interactions manually
		}
	}

	// Initialize functionality
	initTheme();
	initInteractivityFeatures();
});
```

## Pre-commit Hooks

Consider setting up pre-commit hooks to automatically run code quality checks before commits:

```bash
# Add to .git/hooks/pre-commit
#!/bin/sh
echo "Running pre-commit checks..."

# Check PHP code
composer run check
if [ $? -ne 0 ]; then
    echo "PHP code quality check failed!"
    exit 1
fi

# Check CSS code
npm run lint:css
if [ $? -ne 0 ]; then
    echo "CSS linting failed!"
    exit 1
fi

# Check JavaScript code
npm run lint:js
if [ $? -ne 0 ]; then
    echo "JavaScript linting failed!"
    exit 1
fi

echo "All checks passed!"
```

**Auto-fix version (formats code before committing):**
```bash
# Add to .git/hooks/pre-commit
#!/bin/sh
echo "Auto-formatting and checking code..."

# Format and check PHP
composer run format
composer run check

# Format CSS and JavaScript
npm run format

# Final checks
npm run lint:css
npm run lint:js

echo "Code formatted and checked!"
```

## Quick Reference

**All available commands:**

```bash
# Build and Development
npm run build             # Production build
npm run dev               # Development build with watch

# Code Quality - JavaScript/CSS
npm run lint:js           # Check JavaScript
npm run lint:css          # Check CSS
npm run format            # Format JS and CSS

# Code Quality - PHP (via NPM)
npm run lint:php          # Check PHP (via composer)
npm run lint:php:fix      # Fix PHP formatting
npm run format:php        # Format PHP code
npm run check:php         # Check PHP (ignore warnings)

# Maintenance
npm run packages-update   # Update WordPress packages
npm run plugin-zip        # Create distribution zip

# Direct Composer Commands
composer run lint         # Check PHP code
composer run lint:fix     # Fix PHP code formatting
composer run format       # Format PHP code (same as lint:fix)
composer run check        # Check PHP (ignore warnings)
composer run check:summary # Check PHP with summary report
composer run phpcs        # Run phpcs directly
composer run phpcbf       # Run phpcbf directly
composer run install-codestandards # Configure coding standards

# Package Management
composer install          # Install all dependencies
composer install --no-dev # Install production dependencies only
composer update           # Update dependencies
```

## Development Workflow

**For daily development:**
```bash
# 1. Install dependencies
composer install
npm install

# 2. Start development
npm run dev

# 3. Check code quality during development
npm run lint:js
npm run lint:css
composer run check

# 4. Format code before committing
npm run format
composer run format
```

**For production deployment:**
```bash
# 1. Install production dependencies
composer install --no-dev --optimize-autoloader

# 2. Build production assets
npm run build

# 3. Final quality check
composer run check
```