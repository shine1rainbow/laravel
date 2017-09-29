/*
|--------------------------------------------------------------------------
| actions (异步操作)
|--------------------------------------------------------------------------
|
*/

export default {
    //demo
    changeLanguage (context, payload) {
        context.commit('CHANGE_LANGUAGE', payload)
    }
}
