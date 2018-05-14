import Lang from "./Lang";

const lang = new Lang();

export default {

    required(attribute, value) {
        return !! value || lang.get('validation.min.string', { attribute });
    },

    min(attribute, value, length) {
        if (typeof value === 'string') {
            return value.length >= length || lang.get('validation.min.string', { attribute, min: length });
        }
        return true;
    },

    max(attribute, value, length) {
        if (typeof value === 'string') {
            return value.length <= length || lang.get('validation.max.string', { attribute, max: length });
        }
        return true;
    },

    in(attribute, value, options, key = 'id') {
        if (typeof options === 'object') {
            return !! options.filter((option) => option[key] === value ).length || lang.get('validation.in', { attribute });
        }
        console.warn('Available options are incorrect');
        return false;
    }
}