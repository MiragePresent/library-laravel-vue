class Lang {

    constructor() {
        if (typeof window.i18n !== 'object') {
            console.error('Locale variables is not defined');
        } else {
            this.dictionary = window.i18n;
        }
    }
    replaceAttributes(translation, attrs = {}) {
        if (typeof attrs === 'object') {
            for (let key in attrs) {
                if (typeof key === 'string') {
                    translation = translation.replace(`:${key}`, attrs[key]);
                }
            }
        }
        return translation;
    }
    notFound(key) {
        console.warn(`${key} is nod found`);
        return key;
    }
    get(key, attrs = {}) {
        if (key.indexOf('.') > 0) {
            let keys = key.split('.');

            let translation = this.dictionary[keys[0]];

            for (let index in keys) {
                if (typeof translation[keys[index]] !== 'undefined') {
                    translation = translation[keys[index]];
                }
            }

            if (typeof translation === 'string') {
                return this.replaceAttributes(translation, attrs);
            }
        }

        return this.notFound(key);
    }
}

export default Lang;