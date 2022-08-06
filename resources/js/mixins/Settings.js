import store from '../store/index';

export default {

    methods: {
        getSetting: (key) => {
            const settings = store.getters.settings;
            return settings[key];
        },
        getCurrencyData() {
            return this.getSetting('currency');
        },
        getCurrencyPlacementSymbol() {
            return this.getSetting('currency_symbol_placement');
        },
        getCurrency() {
            return this.getCurrencyData().currency;
        },
        getCurrencyCode() {
            return this.getCurrencyData().code;

        },
        getCurrencySymbol() {
            return this.getCurrencyData().symbol;
        },
        getFormattedPrice(price) {

            let symbol = this.getCurrencySymbol();
            let sybmolPlacement = this.getCurrencyPlacementSymbol();

            return (sybmolPlacement === 'before')
                ? symbol + ' ' + price
                : price + ' ' + symbol;
        }

    }
};
