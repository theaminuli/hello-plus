# hello-plus
Hello Plus is a lightweight, fast, and customizable WordPress theme built for speed and flexibility

## Code Formatting & Linting

This project uses ESLint for JavaScript code formatting and Stylelint for CSS code formatting.

### Available Commands

- `npm run lint` - Auto-fix JavaScript and CSS formatting issues
- `npm run lint:js` - Auto-fix JavaScript formatting issues only
- `npm run lint:css` - Auto-fix CSS formatting issues only  
- `npm run lint:check` - Check for formatting issues without fixing

### Setup for Development

1. Install dependencies: `npm install`
2. Install recommended VS Code extensions for automatic formatting
3. Code will be automatically formatted on save in VS Code

### Code Standards

- JavaScript: ES6+ syntax, single quotes, no semicolons, 2-space indentation
- CSS: Standard formatting, short hex colors, proper nesting

### Continuous Integration

GitHub Actions automatically runs linting checks on all pull requests to ensure code quality.
