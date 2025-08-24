/**
 * Script global pour gérer l'affichage mobile avec clavier virtuel
 * S'applique automatiquement à tous les formulaires du site
 */

(() => {
    'use strict';

    // Détecte si on est sur mobile
    const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
    
    if (!isMobile) return; // Ne s'exécute que sur mobile

    let initialViewportHeight = window.innerHeight;
    let currentActiveElement = null;
    let keyboardVisible = false;

    /**
     * Ajuste dynamiquement les paramètres viewport pour mobile
     */
    function setupMobileViewport() {
        const viewport = document.querySelector('meta[name="viewport"]');
        if (viewport) {
            const currentContent = viewport.getAttribute('content');
            // Ajoute les paramètres optimaux pour mobile si pas déjà présents
            if (!currentContent.includes('viewport-fit')) {
                viewport.setAttribute('content', currentContent + ', viewport-fit=cover');
            }
        }
    }

    /**
     * Fonction pour ajuster la page quand le clavier apparaît
     */
    function adjustForKeyboard() {
        const currentViewportHeight = window.innerHeight;
        const heightDifference = initialViewportHeight - currentViewportHeight;
        
        // Si le clavier est probablement ouvert (réduction significative de la hauteur)
        if (heightDifference > 150) {
            if (!keyboardVisible) {
                keyboardVisible = true;
                document.body.style.paddingBottom = heightDifference + 'px';
                
                // Scroll vers l'élément actif avec un délai pour laisser le clavier s'ouvrir
                if (currentActiveElement) {
                    setTimeout(() => {
                        scrollToActiveElement();
                    }, 300);
                }
            }
        } else {
            if (keyboardVisible) {
                keyboardVisible = false;
                // Remet le padding normal
                document.body.style.paddingBottom = '';
            }
        }
    }

    /**
     * Scroll intelligent vers l'élément actif
     */
    function scrollToActiveElement() {
        if (!currentActiveElement) return;

        try {
            // Calcul de la position optimale
            const elementRect = currentActiveElement.getBoundingClientRect();
            const viewportHeight = window.innerHeight;
            
            // Position idéale : 1/3 depuis le haut de l'écran
            const idealPosition = viewportHeight / 3;
            
            if (elementRect.top < idealPosition || elementRect.bottom > viewportHeight - 100) {
                currentActiveElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }
        } catch (error) {
            // Fallback simple en cas d'erreur
            if (currentActiveElement.scrollIntoView) {
                currentActiveElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }
    }

    /**
     * Gestionnaire pour les éléments de saisie
     */
    function setupFormElementHandlers() {
        // Sélecteurs pour tous les éléments de formulaire
        const inputSelectors = [
            'input[type="text"]',
            'input[type="email"]', 
            'input[type="password"]',
            'input[type="number"]',
            'input[type="tel"]',
            'input[type="url"]',
            'input[type="date"]',
            'input[type="time"]',
            'input[type="datetime-local"]',
            'textarea',
            'select'
        ].join(', ');

        const inputElements = document.querySelectorAll(inputSelectors);
        
        inputElements.forEach(element => {
            element.addEventListener('focus', function() {
                currentActiveElement = this;
                // Petit délai pour laisser le clavier s'ouvrir
                setTimeout(adjustForKeyboard, 100);
            });
            
            element.addEventListener('blur', function() {
                // Ne reset pas currentActiveElement immédiatement 
                // au cas où l'utilisateur passe à un autre champ
                setTimeout(() => {
                    if (document.activeElement !== this) {
                        currentActiveElement = null;
                    }
                }, 100);
            });
        });

        // Gestion spéciale pour les radio buttons et checkboxes
        const radioCheckboxElements = document.querySelectorAll('input[type="radio"], input[type="checkbox"]');
        radioCheckboxElements.forEach(element => {
            element.addEventListener('focus', function() {
                // Pour les étoiles, on cible le conteneur parent
                const starRating = this.closest('.star-rating');
                currentActiveElement = starRating || this;
            });
        });
    }

    /**
     * Gestionnaire de redimensionnement avec debounce
     */
    let resizeTimeout;
    function handleResize() {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(adjustForKeyboard, 100);
    }

    /**
     * Amélioration de l'expérience utilisateur pour les formulaires
     */
    function enhanceFormExperience() {
        // Améliore les textarea pour qu'ils s'adaptent au contenu
        const textareas = document.querySelectorAll('textarea');
        textareas.forEach(textarea => {
            // Auto-resize basic
            textarea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = this.scrollHeight + 'px';
            });
        });

        // Améliore l'accessibilité des étoiles sur mobile
        const starRatings = document.querySelectorAll('.star-rating');
        starRatings.forEach(rating => {
            const inputs = rating.querySelectorAll('input[type="radio"]');
            inputs.forEach(input => {
                input.addEventListener('change', function() {
                    // Feedback visuel rapide
                    const label = this.nextElementSibling;
                    if (label) {
                        label.style.transform = 'scale(1.1)';
                        setTimeout(() => {
                            label.style.transform = '';
                        }, 150);
                    }
                });
            });
        });
    }

    /**
     * Initialisation
     */
    function init() {
        // Configuration du viewport
        setupMobileViewport();
        
        // Configuration des gestionnaires
        setupFormElementHandlers();
        
        // Amélioration de l'expérience utilisateur
        enhanceFormExperience();
        
        // Écoute les changements de taille de viewport
        window.addEventListener('resize', handleResize);
        
        // Écoute l'orientation change (spécifique mobile)
        window.addEventListener('orientationchange', () => {
            setTimeout(() => {
                initialViewportHeight = window.innerHeight;
                adjustForKeyboard();
            }, 500);
        });

        console.log('Mobile keyboard handler initialized');
    }

    // Initialisation au chargement du DOM
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    // Re-initialise sur les changements de contenu dynamique
    const observer = new MutationObserver((mutations) => {
        let shouldReinit = false;
        mutations.forEach((mutation) => {
            if (mutation.type === 'childList' && mutation.addedNodes.length > 0) {
                // Vérifie si de nouveaux éléments de formulaire ont été ajoutés
                for (let node of mutation.addedNodes) {
                    if (node.nodeType === 1) { // Element node
                        if (node.matches('form, input, textarea, select') || 
                            node.querySelector('form, input, textarea, select')) {
                            shouldReinit = true;
                            break;
                        }
                    }
                }
            }
        });
        
        if (shouldReinit) {
            setupFormElementHandlers();
            enhanceFormExperience();
        }
    });

    observer.observe(document.body, {
        childList: true,
        subtree: true
    });

})();
