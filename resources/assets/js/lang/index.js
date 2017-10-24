import Vue from 'vue'
import VueI18n from 'vue-i18n';

import en from './en'
import zh_cn from './zh_cn'

Vue.use(VueI18n)

let sessionStorageLocale = window.sessionStorage.getItem('locale')

if (!sessionStorageLocale && typeof(sessionStorageLocale) != "undefined" && sessionStorageLocale != 0) {
    sessionStorageLocale = 'zh_cn'
}

const locale = sessionStorageLocale
//const locale = 'zh_cn'

const messages = {
    zh_cn,
    en
}

/* Create VueI18n instance with options: {zh_cn, en} */
const i18n = new VueI18n({
    locale,
    messages
})

export default i18n
