# Hello Plus

Hello Plus is a lightweight, fast, and customizable WordPress theme built for speed and flexibility.

## Features

- **Lightweight & Fast**: Optimized for performance and speed
- **Highly Customizable**: Flexible design options to match your brand  
- **Responsive Design**: Works perfectly on all devices and screen sizes
- **Modern Interface**: Clean and contemporary design
- **SEO Optimized**: Built with search engine optimization in mind
- **Cross-browser Compatible**: Works across all major browsers

## Installation

1. Download the theme files
2. In your WordPress admin panel, go to **Appearance > Themes**
3. Click **Add New** → **Upload Theme**
4. Choose the theme .zip file and click **Install Now**
5. Click **Activate** to start using the theme

## Development

### Code Quality

This theme includes comprehensive code quality tools:

- **PHP CodeSniffer (phpcs)** with WordPress coding standards
- **Automatic code formatting** with phpcbf
- **CSS linting** with Stylelint
- **JavaScript linting** with ESLint and WordPress standards
- **PHP 7.4+ compatibility checking**

See [CODE_QUALITY.md](CODE_QUALITY.md) for detailed usage instructions.

Quick commands:
```bash
# Install dependencies
composer install
npm install

# Build assets
npm run build        # Production build
npm run dev          # Development build

# Check PHP code
composer run check

# Fix PHP formatting
composer run format

# Check CSS
npm run lint:css

# Check JavaScript
npm run lint:js

# Check both CSS and JavaScript
npm run lint

# Fix both CSS and JavaScript
npm run format
```

## Requirements

- WordPress 6.0 or higher
- PHP 7.4 or higher

## License

This theme is licensed under the GPL v3 or later - see the [LICENSE](LICENSE) file for details.

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.
