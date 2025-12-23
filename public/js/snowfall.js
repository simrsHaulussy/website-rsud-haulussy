/**
 * Lightweight snow animation using HTML5 Canvas
 * Pure JavaScript implementation without external dependencies
 */

class Snowflake {
    constructor(canvas) {
        this.canvas = canvas;
        this.reset();
        this.wind = Math.random() * 0.5 - 0.25;
        this.swing = Math.random() * 2 - 1;
        this.swingSpeed = Math.random() * 0.05 + 0.03;
    }

    reset() {
        this.x = Math.random() * this.canvas.width;
        this.y = Math.random() * this.canvas.height - this.canvas.height;
        this.radius = Math.random() * 3 + 1;
        this.speed = Math.random() * 2 + 0.5;
        this.opacity = Math.random() * 0.6 + 0.4;
    }

    update() {
        this.y += this.speed;
        this.x += this.wind + Math.sin(this.y * this.swingSpeed) * this.swing;

        // Reset when snowflake exceeds screen bounds
        if (this.y > this.canvas.height + 10) {
            this.reset();
            this.y = -10;
        }

        // Maintain horizontal bounds
        if (this.x < -10) {
            this.x = this.canvas.width + 10;
        } else if (this.x > this.canvas.width + 10) {
            this.x = -10;
        }
    }

    draw(ctx) {
        ctx.beginPath();
        ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
        ctx.globalAlpha = this.opacity;
        ctx.fillStyle = '#ffffff';
        ctx.fill();
    }
}

class Snowfall {
    constructor(options = {}) {
        this.canvas = null;
        this.ctx = null;
        this.snowflakes = [];
        this.isRunning = false;
        this.animationId = null;

        // Configuration settings
        this.config = {
            maxSnowflakes: options.maxSnowflakes || 50,
            autoActivate: options.autoActivate !== undefined ? options.autoActivate : true,
            months: options.months || [11, 12, 1],
            manualOverride: options.manualOverride !== undefined ? options.manualOverride : null,
            zIndex: options.zIndex || 9998,
            ...options
        };

        this.init();
    }

    init() {
        this.setupCanvas();
        this.createSnowflakes();

        // Activate based on configuration settings
        if (this.shouldActivate()) {
            this.start();
        }

        // Bind resize event handler
        window.addEventListener('resize', this.handleResize.bind(this));
    }

    setupCanvas() {
        this.canvas = document.createElement('canvas');
        this.canvas.id = 'snowfall-canvas';
        this.canvas.style.position = 'fixed';
        this.canvas.style.top = '0';
        this.canvas.style.left = '0';
        this.canvas.style.width = '100%';
        this.canvas.style.height = '100%';
        this.canvas.style.pointerEvents = 'none';
        this.canvas.style.zIndex = this.config.zIndex;
        this.canvas.style.opacity = '1';

        this.ctx = this.canvas.getContext('2d');

        // Set canvas size
        this.resizeCanvas();

        // Append to container or body
        const container = document.getElementById('snowfall-container') || document.body;
        container.appendChild(this.canvas);
    }

    resizeCanvas() {
        this.canvas.width = window.innerWidth;
        this.canvas.height = window.innerHeight;
    }

    createSnowflakes() {
        const count = Math.min(this.config.maxSnowflakes, 60);
        this.snowflakes = [];

        for (let i = 0; i < count; i++) {
            this.snowflakes.push(new Snowflake(this.canvas));
        }
    }

    shouldActivate() {
        // Manual override takes precedence
        if (this.config.manualOverride !== null) {
            return this.config.manualOverride;
        }

        // Auto-activation based on configuration
        if (!this.config.autoActivate) {
            return false;
        }

        const currentMonth = new Date().getMonth();
        return this.config.months.includes(currentMonth);
    }

    start() {
        if (this.isRunning) return;

        this.isRunning = true;
        this.animate();
    }

    stop() {
        if (!this.isRunning) return;

        this.isRunning = false;

        if (this.animationId) {
            cancelAnimationFrame(this.animationId);
            this.animationId = null;
        }
    }

    destroy() {
        this.stop();

        // Clean up event listeners
        window.removeEventListener('resize', this.handleResize.bind(this));

        // Remove canvas
        if (this.canvas && this.canvas.parentNode) {
            this.canvas.parentNode.removeChild(this.canvas);
        }

        // Clear references
        this.canvas = null;
        this.ctx = null;
        this.snowflakes = [];
    }

    handleResize() {
        this.resizeCanvas();

        // Recreate snowflakes if configuration changed
        const currentCount = this.snowflakes.length;
        if (currentCount !== this.config.maxSnowflakes) {
            this.createSnowflakes();
        }
    }

    animate() {
        if (!this.isRunning) return;

        // Clear canvas for redraw
        this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);

        // Process all snowflakes
        this.snowflakes.forEach(snowflake => {
            snowflake.update();
            snowflake.draw(this.ctx);
        });

        // Request next animation frame
        this.animationId = requestAnimationFrame(() => this.animate());
    }

    // Manual override methods
    manualOverride(override) {
        this.config.manualOverride = override;

        if (override) {
            this.start();
        } else {
            this.stop();
        }
    }

    // Get current state
    isActive() {
        return this.isRunning;
    }

    // Get configuration
    getConfig() {
        return { ...this.config };
    }

    // Update configuration
    updateConfig(newConfig) {
        this.config = { ...this.config, ...newConfig };

        // Recreate snowflakes if max count changed
        if (newConfig.maxSnowflakes !== undefined) {
            this.createSnowflakes();
        }
    }
}

// Auto-initialize if script is loaded directly
if (typeof window !== 'undefined') {
    window.Snowfall = Snowfall;

    // Global instance for easy access
    window.snowfallInstance = null;

    // Auto-initialize with default settings when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            window.snowfallInstance = new Snowfall();
        });
    } else if (document.readyState === 'interactive' || document.readyState === 'complete') {
        window.snowfallInstance = new Snowfall();
    }
}