/*
|--------------------------------------------------------------------------
| Encrypt and Decrypt 
|--------------------------------------------------------------------------
|
| We'll encrypt the data before store in the browser with Aes.
|
*/

import { CryptoJS, AES, enc } from 'crypto-js'
import systemConfig from './../env.js'

export function encryptData(str) {
    let encryptStr = AES.encrypt(JSON.stringify(str), systemConfig.encryptKey);

    return encryptStr;
}

export function decryptData(str) {
    if (str === null) {
        return '';
    }

    let bytes = AES.decrypt(str.toString(), systemConfig.encryptKey)
    let decryptedStr = JSON.parse(bytes.toString(enc.Utf8))

    return decryptedStr;
}
