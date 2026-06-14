// Payment method selector component
export default function paymentSelectorComponent() {
    return {
        selectedMethod: null,
        methods: [],

        init() {
            const methodElements = this.$el.querySelectorAll('[data-payment-method]');
            this.methods = Array.from(methodElements).map(el => ({
                id: el.dataset.paymentMethod,
                element: el,
            }));
        },

        selectMethod(methodId) {
            this.selectedMethod = methodId;

            this.methods.forEach(method => {
                if (method.id === methodId) {
                    method.element.classList.add('ring-2', 'ring-secondary-900', 'bg-secondary-50');
                    method.element.classList.remove('hover:shadow-lg');
                } else {
                    method.element.classList.remove('ring-2', 'ring-secondary-900', 'bg-secondary-50');
                    method.element.classList.add('hover:shadow-lg');
                }
            });

            // Dispatch event
            this.$dispatch('payment-method-selected', { method: methodId });
        },

        getSelectedMethod() {
            return this.selectedMethod;
        },

        isMethodSelected(methodId) {
            return this.selectedMethod === methodId;
        }
    };
}
