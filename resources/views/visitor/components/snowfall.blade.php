@php
    /**
     * Snowfall Component Configuration
     *
     * Configuration sourced from database visual effects settings
     */

    // Extract settings from database config array
    $maxSnowflakes = isset($config['max_snowflakes']) ? (int)$config['max_snowflakes'] : 50;
    $snowfallMonths = isset($config['snowfall_months']) ? $config['snowfall_months'] : '11,12,1';

    // Convert months string to array
    $monthsArray = array_map('intval', explode(',', $snowfallMonths));

    // Configuration object passed to JavaScript
    $snowfallConfig = [
        'maxSnowflakes' => $maxSnowflakes,
        'autoActivate' => true,
        'months' => $monthsArray,
        'manualOverride' => null,
        'zIndex' => 9998,
    ];

    // Environment-specific adjustments
    if (app()->environment() === 'local') {
        $snowfallConfig['maxSnowflakes'] = min($maxSnowflakes, 30);
    }

    // Mobile optimization using user agent detection
    $isMobile = preg_match('/(Android|webOS|iPhone|iPad|iPod|BlackBerry|Windows Phone|IEMobile|Opera Mini)/i', request()->userAgent());
    if ($isMobile) {
        $snowfallConfig['maxSnowflakes'] = min($maxSnowflakes, 35);
    }
@endphp

<!-- Snowfall CSS -->
    <link href="{{ asset('css/snowfall.css') }}" rel="stylesheet" />

    <!-- Snowfall Container -->
    <div id="snowfall-container"></div>

    <!-- Snowfall JavaScript -->
    <script src="{{ asset('js/snowfall.js') }}"></script>

    <!-- Snowfall Initialization -->
    <script>
        (function() {
            'use strict';

            // Wait for DOM to be ready
            function initSnowfall() {
                try {
                    // Configuration from PHP
                    const config = !!json({!!$snowfallConfig}});

                    // Check if snowfall is already initialized
                    if (window.snowfallInstance) {
                        window.snowfallInstance.destroy();
                    }

                    // Initialize new snowfall instance
                    window.snowfallInstance = new Snowfall(config);

                    // Store reference for global access
                    window.toggleSnowfall = function(enable) {
                        if (window.snowfallInstance) {
                            window.snowfallInstance.manualOverride(enable);
                        }
                    };

                    // Manual toggle functions
                    window.enableSnowfall = function() {
                        window.toggleSnowfall(true);
                    };

                    window.disableSnowfall = function() {
                        window.toggleSnowfall(false);
                    };

                    // Get current state
                    window.isSnowfallActive = function() {
                        return window.snowfallInstance ? window.snowfallInstance.isActive() : false;
                    };

                    console.log('Snowfall effect initialized with config:', config);

                } catch (error) {
                    console.warn('Snowfall initialization failed:', error);
                }
            }

            // Initialize when DOM is ready
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initSnowfall);
            } else {
                initSnowfall();
            }

        })();
    </script>

@php
/**
 * Snowfall Effect Control API
 *
 * Available global functions for runtime control:
 *
 * window.enableSnowfall()          - Activate snowfall effect
 * window.disableSnowfall()         - Deactivate snowfall effect
 * window.toggleSnowfall(boolean)   - Set snowfall state
 * window.isSnowfallActive()        - Returns current activation state
 * window.snowfallInstance.getConfig() - Retrieve configuration object
 * window.snowfallInstance.updateConfig(object) - Update runtime settings
 */
@endphp