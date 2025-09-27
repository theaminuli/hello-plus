/**
 * Sample JavaScript for Hello Plus theme
 * This file demonstrates JS linting and formatting capabilities using WordPress Interactivity API
 *
 * @package HelloPlus
 */

/* eslint-env browser */

document.addEventListener('DOMContentLoaded', function () {
	'use strict';

	/**
	 * Initializes the theme JavaScript functionality
	 *
	 * @return {void}
	 */
	function initTheme() {
		// Sample theme initialization
		// eslint-disable-next-line no-console
		console.log('Hello Plus theme initialized');
	}

	/**
	 * Handles responsive navigation toggle using native JavaScript
	 *
	 * @param {Element} menuToggle - The menu toggle button element
	 * @param {Element} navigation - The navigation menu element
	 * @return {void}
	 */
	function handleNavigationToggle(menuToggle, navigation) {
		if (!menuToggle || !navigation) {
			return;
		}

		menuToggle.addEventListener('click', function (event) {
			event.preventDefault();
			navigation.classList.toggle('is-open');
			menuToggle.setAttribute(
				'aria-expanded',
				navigation.classList.contains('is-open')
			);
		});
	}

	/**
	 * Validates user input for theme settings
	 *
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

	/**
	 * Example of WordPress Interactivity API usage (when available)
	 * This demonstrates how to structure interactive components
	 *
	 * @return {void}
	 */
	function initInteractivityFeatures() {
		// Check if wp.interactivity is available (WordPress 6.5+)
		if (typeof wp !== 'undefined' && wp.interactivity) {
			// Example: Register interactive behavior
			// This would be used with data-wp-interactive attribute in HTML
			/*
			wp.interactivity.state({
				theme: {
					isMenuOpen: false
				}
			});

			wp.interactivity.actions({
				theme: {
					toggleMenu: () => {
						const { state } = wp.interactivity.getContext();
						state.theme.isMenuOpen = !state.theme.isMenuOpen;
					}
				}
			});
			*/
		} else {
			// Fallback to vanilla JavaScript for older WordPress versions
			const menuToggle = document.querySelector('.menu-toggle');
			const navigation = document.querySelector('.main-navigation');
			handleNavigationToggle(menuToggle, navigation);
		}
	}

	// Initialize theme functionality
	initTheme();
	initInteractivityFeatures();

	// Example usage of validateUserInput to demonstrate the function
	const emailResult = validateUserInput('test@example.com', 'email');
	if (emailResult.isValid) {
		// Process valid email
	}
});
