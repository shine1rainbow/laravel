<template>
  <div class="components-container">

	<el-button type="primary" icon="el-icon-upload" round @click="toggleShow">set avatar</el-button>

	<my-upload field="file"
        @crop-success="cropSuccess"
        @crop-upload-success="cropUploadSuccess"
        @crop-upload-fail="cropUploadFail"
        v-model="show"
		:width="300"
		:height="300"
		url="api/v1/backend/shop/uploadImg"
		:params="params"
		:headers="headers"
		img-format="png">
	</my-upload>
	<img :src="imgDataUrl">

  </div>
</template>

<script>
    import myUpload from 'vue-image-crop-upload'
    import ApList from './../../config.js'
    import {getHttpHeader} from './../../utils/util.js'

export default {
    name: 'AvatarUploadDemo',
    components: {'my-upload': myUpload },
    data() {
        return {
            show: false,
            params: {
                type: 'restaurant_background',
            },
            headers: getHttpHeader(),
            imgDataUrl: ''
        }
    },

    methods: {
        toggleShow() {
            this.show = !this.show;
        },

        /**
        * crop success
        *
        * [param] imgDataUrl
        * [param] field
        */
        cropSuccess(imgDataUrl, field){
            console.log('-------- crop success --------');
            this.imgDataUrl = imgDataUrl;
        },

        /**
        * upload success
        *
        * [param] jsonData  server api return data, already json encode
        * [param] field
        */
        cropUploadSuccess(jsonData, field){
            console.log('-------- upload success --------');
            console.log(jsonData);
            console.log('field: ' + field);
        },
        /**
        * upload fail
        *
        * [param] status    server api return error status, like 500
        * [param] field
        */
        cropUploadFail(status, field){
            console.log('-------- upload fail --------');
            console.log(status);
            console.log('field: ' + field);
        }
    }
}
</script>

<style scoped>
  .avatar{
    width: 200px;
    height: 200px;
    border-radius: 50%;
  }
</style>
