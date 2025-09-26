/**
 * Sample JavaScript for Hello Plus theme
 * This file demonstrates JS linting and formatting capabilities
 *
 * @package HelloPlus
 */

/* eslint-env browser, jquery */

(function ($) {
	'use strict';

	/**
	 * Initializes the theme JavaScript functionality
	 * @return {void}
	 */
	function initTheme() {
		// Sample theme initialization
		// eslint-disable-next-line no-console
		console.log('Hello Plus theme initialized');
	}

	/**
	 * Handles responsive navigation toggle
	 * @param {jQuery} $menuToggle - The menu toggle button element
	 * @param {jQuery} $navigation - The navigation menu element
	 * @return {void}
	 */
	function handleNavigationToggle($menuToggle, $navigation) {
		if (!$menuToggle.length || !$navigation.length) {
			return;
		}

		$menuToggle.on('click', function (event) {
			event.preventDefault();
			$navigation.toggleClass('is-open');
			$(this).attr('aria-expanded', $navigation.hasClass('is-open'));
		});
	}

	/**
	 * Validates user input for theme settings
	 * @param {string} input - The raw user input to validate
	 * @param {string} type  - The expected type (email, url, text, etc.)
	 * @return {Object} An object containing {isValid: boolean, sanitized: string, error?: string}
	 * @example
	 * const result = validateUserInput('user@example.com', 'email');
	 * if (result.isValid) {
	 *   console.log('Clean email:', result.sanitized);
	 * }
	 */
	function validateUserInput(input, type) {
		if (typeof input !== 'string' || !input.trim()) {
			return {
				isValid: false,
				sanitized: '',
				error: 'Input must be a non-empty string',
			};
		}

		const trimmedInput = input.trim();
		let isValid = false;
		let sanitized = trimmedInput;

		switch (type) {
			case 'email':
				isValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(trimmedInput);
				break;
			case 'url':
				try {
					new URL(trimmedInput);
					isValid = true;
				} catch {
					isValid = false;
				}
				break;
			case 'text':
				isValid = trimmedInput.length > 0;
				sanitized = trimmedInput.replace(/[<>]/g, '');
				break;
			default:
				isValid = trimmedInput.length > 0;
		}

		return {
			isValid,
			sanitized,
			error: isValid ? undefined : `Invalid ${type} format`,
		};
	}

	// Initialize when DOM is ready
	$(document).ready(function () {
		initTheme();

		// Initialize navigation toggle
		const $menuToggle = $('.menu-toggle');
		const $navigation = $('.main-navigation');
		handleNavigationToggle($menuToggle, $navigation);

		// Example usage of validateUserInput to avoid unused variable warning
		const emailResult = validateUserInput('test@example.com', 'email');
		if (emailResult.isValid) {
			// Process valid email
		}
	});
})(jQuery);
