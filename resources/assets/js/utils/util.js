import { decryptData } from './encrypt'

export function getUserId() {
    let encryptAuthUser = window.localStorage.getItem('authUser')
    let decryptedAuthUser = decryptData(encryptAuthUser);
    return decryptedAuthUser.id;
}
