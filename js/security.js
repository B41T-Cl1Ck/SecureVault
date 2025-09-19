// Système de sécurité basique
class SecurityManager {
    constructor() {
        this.initSecurity();
    }

    initSecurity() {
        this.checkUserAgent();
        this.preventRightClick();
        this.logAccess();
    }

    checkUserAgent() {
        const userAgent = navigator.userAgent;
        console.log(`[SECURITY] User agent detected: ${userAgent}`);
    }

    preventRightClick() {
        document.addEventListener('contextmenu', function(e) {
            e.preventDefault();
            console.log('[SECURITY] Right click blocked');
        });
    }

    logAccess() {
        const timestamp = new Date().toISOString();
        const page = window.location.pathname;
        console.log(`[ACCESS LOG] ${timestamp} - Page accessed: ${page}`);
    }
}

// Initialisation
document.addEventListener('DOMContentLoaded', function() {
    new SecurityManager();
});