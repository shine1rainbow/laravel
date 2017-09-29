import axios from 'axios'
import { Notification } from 'element-ui'
import { systemConfig } from './../env.js'

/**
 * Create Axios
 */
export const http = axios.create({
    baseURL: systemConfig.baseURL,
	timeout: 5000
})

//在实例创建后改变默认值
//http.defaults.headers.common ['Authorization'] = AUTH_TOKEN;

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */
http.defaults.headers.common = {
	'X-CSRF-ToKen': document.querySelector('meta[name=csrf-token]').getAttribute('content'), 
	'X-Requested-With': 'XMLHttpRequest',
};

http.interceptors.request.use(config => {
  // Do something before request is sent
  return config
}, error => {
  // Do something with request error
  Promise.reject(error)
})

http.interceptors.response.use(function (response) {
    return response;
}, function (error) {
    const { response } = error

    if ([401].indexOf(response.status) >= 0) {
      if (response.status == 401 && response.data.message != 'Unauthorized') {
        return Promise.reject(response);
      }
      window.location = '/login';
    }
	
	//多种错误代码进行判断
    if ([500].indexOf(response.status) >= 0) {
		Notification.error({
			title: 'Error',
			message: 'Whoos, something went wrong.',
			duration: 1500
		})
    }

    return Promise.reject(error);
});

export default function install(Vue) {
  Object.defineProperty(Vue.prototype, '$http', {
    get() {
      return http
    },
  })
}