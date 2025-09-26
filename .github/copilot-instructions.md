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

#### 1. Add Descriptive JSDoc Comments
```javascript
/**
 * Validates and sanitizes user input for theme settings
 * @param {string} input - The raw user input to validate
 * @param {string} type - The expected type (email, url, text, etc.)
 * @returns {Object} An object containing {isValid: boolean, sanitized: string, error?: string}
 * @example
 * const result = validateUserInput('user@example.com', 'email');
 * if (result.isValid) {
 *   console.log('Clean email:', result.sanitized);
 * }
 */
function validateUserInput(input, type) {
  // Implementation here
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

### PHP Development (if applicable)
- Follow WordPress PHP coding standards
- Sanitize all user inputs and escape all outputs
- Use WordPress hooks and filters appropriately
- Include proper error handling and validation
- Document functions with PHPDoc comments

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

## Example Function Template
When creating new functions, use this template:

```javascript
/**
 * [Brief description of what the function does]
 * @param {type} paramName - Description of parameter
 * @returns {type} Description of return value
 * @throws {Error} Description of when errors are thrown
 * @example
 * // Practical usage example
 * const result = functionName(exampleParam);
 */
function functionName(paramName) {
  // Input validation
  if (!paramName || typeof paramName !== 'expectedType') {
    throw new Error('Invalid parameter: paramName must be a valid expectedType');
  }
  
  // Early return for edge cases
  if (edgeCondition) {
    return defaultValue;
  }
  
  // Main logic with meaningful variable names
  const processedResult = processInput(paramName);
  
  return processedResult;
}
```

Remember: Code should be self-documenting through good naming and structure, with comments explaining the "why" rather than the "what".