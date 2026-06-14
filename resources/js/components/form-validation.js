// Form validation component
import FormValidationService from '../utils/validators';

export default function formValidationComponent() {
    return {
        fields: {},
        errors: {},

        init() {
            const inputs = this.$el.querySelectorAll('[data-validate]');
            inputs.forEach(input => {
                const fieldName = input.dataset.validate;
                this.fields[fieldName] = input;

                input.addEventListener('blur', () => this.validateField(fieldName));
                input.addEventListener('change', () => this.validateField(fieldName));
            });
        },

        validateField(fieldName) {
            const input = this.fields[fieldName];
            if (!input) return;

            const value = input.value.trim();
            const errors = FormValidationService.validate(fieldName, value);

            if (errors.length > 0) {
                this.setFieldError(fieldName, errors[0]);
                input.classList.add('border-red-500', 'ring-red-200');
                input.classList.remove('border-gray-300');
            } else {
                this.clearFieldError(fieldName);
                input.classList.remove('border-red-500', 'ring-red-200');
                input.classList.add('border-gray-300');
            }

            return errors.length === 0;
        },

        setFieldError(fieldName, error) {
            this.errors[fieldName] = error;
            this.$dispatch('field-error', { field: fieldName, error });
        },

        clearFieldError(fieldName) {
            delete this.errors[fieldName];
            this.$dispatch('field-error-cleared', { field: fieldName });
        },

        hasErrors() {
            return Object.keys(this.errors).length > 0;
        },

        getErrors() {
            return this.errors;
        },

        validateAll() {
            let valid = true;
            Object.keys(this.fields).forEach(fieldName => {
                if (!this.validateField(fieldName)) {
                    valid = false;
                }
            });
            return valid;
        }
    };
}
