/**
 * Soft UI Dashboard Settings Manager
 * This script handles saving and loading UI preferences for the Soft UI Dashboard
 */

document.addEventListener("DOMContentLoaded", function () {
    // Load saved settings when the page loads, with a small delay to ensure DOM is ready
    // setTimeout(loadSettings, 300);
    loadSettings()

    // Add event listeners to settings elements
    setupSettingsListeners();
});


// Initialize dynamic color system
document.addEventListener('DOMContentLoaded', function() {
    // Load saved color settings on page load
    const savedSettings = localStorage.getItem('softUiSettings');
    if (savedSettings) {
        try {
            const settings = JSON.parse(savedSettings);
            if (settings.sidebarColor) {
                // Apply the saved primary color
                updatePrimaryColorFromSettings(settings.sidebarColor);
            }
        } catch (error) {
            console.error('Error loading color settings:', error);
        }
    }
    document.documentElement.classList.remove('theme-loading');
});

function updatePrimaryColorFromSettings(colorName) {
    const colorMap = {
        default: '#f97316',
        primary: "#cb0c9f",
        secondary: "#8392ab",
        success: "#82d616",
        info: "#17a2b8",
        warning: "#fbcf33",
        danger: "#ea0606",
        light: "#e9ecef",
        dark: "#344767",
        white: "#ffffff"
    };

    const selectedColor = colorMap[colorName];
    
    if (selectedColor) {
        document.documentElement.style.setProperty('--primary-color', selectedColor);
        document.documentElement.style.setProperty('--primary-rgb', hexToRgb(selectedColor));
        document.documentElement.style.setProperty('--bs-primary', selectedColor);
        document.documentElement.style.setProperty('--bs-primary-rgb', hexToRgb(selectedColor));
    }
}

function hexToRgb(hex) {
    const result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
    return result ? `${parseInt(result[1], 16)}, ${parseInt(result[2], 16)}, ${parseInt(result[3], 16)}` : null;
}

/**
 * Sets up event listeners for the UI settings components
 */
function setupSettingsListeners() {
    // Sidebar color settings
    document
        .querySelectorAll(".badge-colors .badge.filter")
        .forEach((badge) => {
            badge.addEventListener("click", function () {
                const color = this.getAttribute("data-color");
                saveSettings("sidebarColor", color);
                // Original sidebarColor function will still be called through the onclick attribute
                updatePrimaryColorFromSettings(color);
            });
        });

    // Sidebar type settings
    document.querySelectorAll("[data-class]").forEach((button) => {
        button.addEventListener("click", function () {
            const sidenavType = this.getAttribute("data-class");
            saveSettings("sidebarType", sidenavType);
            // Original sidebarType function will still be called through the onclick attribute
        });
    });

    // Navbar fixed setting
    const navbarFixedCheckbox = document.getElementById("navbarFixed");
    if (navbarFixedCheckbox) {
        navbarFixedCheckbox.addEventListener("change", function () {
            saveSettings("navbarFixed", this.checked);
            // Original navbarFixed function will still be called through the onclick attribute
        });
    }
}

/**
 * Saves a setting to localStorage
 * @param {string} key - The key for the setting
 * @param {any} value - The value to save
 */
function saveSettings(key, value) {
    try {
        const settings = getSettings();
        settings[key] = value;
        localStorage.setItem("softUiSettings", JSON.stringify(settings));
        console.log(`Saved setting: ${key} = ${value}`);
    } catch (error) {
        console.error("Error saving settings:", error);
    }
}

/**
 * Gets all saved settings
 * @returns {Object} The saved settings object or an empty object if none exists
 */
function getSettings() {
    try {
        const settings = localStorage.getItem("softUiSettings");
        return settings ? JSON.parse(settings) : {};
    } catch (error) {
        console.error("Error getting settings:", error);
        return {};
    }
}

/**
 * Loads saved settings and applies them to the UI
 */
function loadSettings() {
    try {
        const settings = getSettings();

        // Apply sidebar color
        if (settings.sidebarColor) {
            const colorBadge = document.querySelector(
                `.badge.filter[data-color="${settings.sidebarColor}"]`,
            );
            if (colorBadge) {
                // Remove active class from all badges
                document.querySelectorAll(".badge.filter").forEach((badge) => {
                    badge.classList.remove("active");
                });
                // Add active class to selected badge
                colorBadge.classList.add("active");
                // Apply the color
                sidebarColor(colorBadge);
            }
        }

        // Apply sidebar type
        if (settings.sidebarType) {
            const typeButton = document.querySelector(
                `[data-class="${settings.sidebarType}"]`,
            );
            if (typeButton) {
                // Check if window width is sufficient for sidebar type (avoid errors on mobile)
                if (window.innerWidth >= 1200) {
                    // Remove active class from all buttons
                    document
                        .querySelectorAll("[data-class]")
                        .forEach((button) => {
                            button.classList.remove("active");
                        });
                    // Add active class to selected button
                    typeButton.classList.add("active");

                    try {
                        // Apply the type - wrapped in try/catch to prevent errors
                        sidebarType(typeButton);
                    } catch (e) {
                        console.warn("Could not apply sidebar type:", e);
                    }
                }
            }
        }

        // Apply navbar fixed setting
        if (settings.hasOwnProperty("navbarFixed") && settings.navbarFixed) {
            const navbarFixedCheckbox = document.getElementById("navbarFixed");
            if (navbarFixedCheckbox) {
                navbarFixedCheckbox.checked = settings.navbarFixed;

                try {
                    // Make sure the navbar exists before trying to modify it
                    if (document.getElementById("navbarBlur")) {
                        navbarFixed(navbarFixedCheckbox);
                    }
                } catch (e) {
                    console.warn("Could not apply navbar fixed setting:", e);
                }
            }
        }

        console.log("Settings loaded successfully");
    } catch (error) {
        console.error("Error loading settings:", error);
    }
}

/**
 * Clears all saved settings
 */
function clearSettings() {
    try {
        localStorage.removeItem("softUiSettings");
        console.log("Settings cleared");
    } catch (error) {
        console.error("Error clearing settings:", error);
    }
}

/**
 * Safe wrapper for function execution
 * @param {Function} fn - The function to execute
 * @param {Array} args - Arguments to pass to the function
 * @returns {*} The result of the function or null if error
 */
function safeExecute(fn, ...args) {
    try {
        return fn(...args);
    } catch (error) {
        console.warn(`Error executing function: ${fn.name}`, error);
        return null;
    }
}
