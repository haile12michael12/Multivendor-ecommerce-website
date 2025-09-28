/**
 * Translation helper for JavaScript
 */
window.__ = function(key, replacements = {}) {
    let translation = window.translations && window.translations[key] ? window.translations[key] : key;
    
    // Handle replacements
    Object.keys(replacements).forEach(placeholder => {
        translation = translation.replace(`:${placeholder}`, replacements[placeholder]);
    });
    
    return translation;
};