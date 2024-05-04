import { createI18n } from "vue-i18n";
// langs
import enLang from "./langs/en";
import bnLang from "./langs/bn";

const i18n = createI18n({
    locale: "en",
    messages: {
        en: enLang,
        bn: bnLang,
    },
});

export default i18n;
