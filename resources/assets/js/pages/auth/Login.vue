<template>
    <div id="form-container">
        <particle-background></particle-background>

        <div id="set-language">
            <el-button type="primary" v-show="isShow" @click="setLanguage('zh_cn')" round>中文</el-button>
            <el-button type="success" v-show="!isShow" @click="setLanguage('en')" round>English</el-button>
        </div>

        <div id="login-form">

            <div id="login-title">
                <h3>{{ $t('auth.loginTitle') }}</h3>
            </div>

            <form class="form">
                <input type="text" class="form-control" name="username" :placeholder="$t('auth.loginUsername')"
                       v-model="newFormData.username"
                >

                <input type="password" class="form-control" id="input-password" name="password" :placeholder="$t('auth.loginPassword')"
                       v-model="newFormData.password"
                >

                <div class="form-group">
                    <router-link to="password/email"> {{ $t('auth.loginForgetPasswd') }}</router-link>
                </div>

                <button type="submit" class="btn btn-primary" id="login-button"
                        v-bind="{'disabled': disabled}"
                        v-on:click="onSubmitForm"
                >
                    {{ $t('auth.loginSubmit') }} <i class="fa fa-sign-in"></i>
                </button>

                <div class="form-group">
                    <a id="company-link" :href="$t('auth.loginCompanyLink')">
                        <p class="text-center"> {{ $t('auth.loginCompanyName') }} </p>
                    </a>
                </div>
            </form>

        </div>
    </div>
</template>

<script>
    import ParticleBackground from './../../components/background/ParticleBackground'
    import ApiList from './../../config'
    import systemConfig from './../../env'
    import { http } from './../../utils/fetch'
    import { encryptData, decryptData } from './../../utils/encrypt'

    export default {
        components: {
            ParticleBackground
        },

        data() {
            return {
                newFormData: {
                    username: '',
                    password: '',
                },
                submitted: false,
                formDatas: [],
                showError: false,
                isShow: false,
            }
        },

        created() {

            if (window.localStorage.getItem('authUser') !== null) {
                this.$router.push('dashboard')
            }

            if (window.sessionStorage.getItem('locale') == 'en') {
                this.isShow = true;
            }
        },

        computed: {
            disabled: function () {
                for (var key in this.newFormData) {
                    if (!this.newFormData[key]) return true;
                }
                return false;
            }
        },

        methods: {

            setLanguage: function(lang){
                    this.$store.dispatch('setLanguage', lang)
                    this.isShow = ! this.isShow
            },

            onSubmitForm: function (e) {

                // prevent the default action
                e.preventDefault();

                var formData = this.newFormData;

                const postData = {
                    grant_type: 'password',
                    client_id: systemConfig.clientId,
                    client_secret: systemConfig.clientSecret,
                    username: this.newFormData.username,
                    password: this.newFormData.password,
                    scope: ''
                }

                const authUser = {}

                // add new message to 'messages' array
                this.formDatas.push(formData);

                // reset input values
                this.formData = {username: '', password: ''};

                // send post ajax request
                http({
					url: ApiList.getTokenUrl, 
					method: 'post',
					data: postData
				}).then(response => {
                    if (response.status == 200) {
                        
						authUser.access_token = response.data.access_token
						authUser.refresh_token = response.data.refresh_token

                    	this.$store.dispatch('setAccessToken', response.data.access_token)

						let encryptAuthUser = encryptData(authUser)

						window.localStorage.setItem('authUser', encryptAuthUser)

						http({
							url: ApiList.getUserInfoUrl,
						}).then(response => {                                                                
																											 
							if (response.data.code == '200') {                                               
																											 
								let resUserInfo = response.data.data.userInfo                                
								let resRoleInfo = response.data.data.roleInfo                                
								let roleLength = resRoleInfo.length                                          
								let roles = []                                                               
																											 
								for (let i = 0; i < roleLength; i++) {                                       
									roles.push(resRoleInfo[i]['name'])                                       
								}                                                                            
																											 
								authUser.id = resUserInfo.id                                                 
								authUser.email = resUserInfo.email                                           
								authUser.name = resUserInfo.name                                             
								authUser.roles = roles                                                       
																											 
								var encryptAuthUser = encryptData(authUser)                                  
								var encryptVersion = encryptData(systemConfig.version);                             
																											 
								window.localStorage.setItem('authUser', encryptAuthUser)                     
								window.localStorage.setItem('version', encryptVersion)                       
								this.$router.push('/dashboard')                                        
																											 
							} else {                                                                         
								this.$message.error(this.$i18n.t("common.loginSuccess") + response.body.msg);
							}                                                                                
						}, response => {                                                                     
							this.$message.error(this.$i18n.t("common.loginFailed"));                         
						})                                                                                   
                    }

                }).catch(err => {
                    console.log(err)
                })

                this.submitted = true;
            }
        }
    }
</script>

<style scoped>
    #form-container {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
    }

    #login-title {
        text-align: center;
        margin-bottom: 20px;

        color: #fff;
    }

    #login-form {
        z-index: 1;
        position: relative;
        top: 15%;
        margin-top: 15%;
        width: 340px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        margin: auto;
        padding: 30px 40px;

        border-radius: 10px;
        background: rgba(255, 255, 255, 0.1);
    }

    #login-form input {
        border-radius: 5px;
    }

    #input-password {
        margin: 8px 0 15px;

        border: solid 1px rgba(255, 255, 255, 0.3);
    }

    #login-button {
        width: 100%;
        margin: 0 auto 20px;
    }

    #login-button:focus {
        border: transparent;
    }

    #forget-password-link:hover {
        color: #0dd9fb;
    }

    #company-link {
        font-size: 12px;
    }

    .form-group a {
        color: #fff;
        text-decoration: none;
    }

    .form-group button {
        border: none;
    }
    #set-language {
        z-index: 1;
        position: absolute;
        top: 10px;
        right: 120px;
        width: 30px;
        margin: auto;
        display: inline-block;
    }
</style>
