<template>
  <div class="components-container">
  <div class="box box-warning shopOpeningTime">
    <div class="box-body" style="margin: 0 auto">
    <el-form :model="form" :rules="rules" ref="form" label-width="100px" class="demo-form">
        <el-form-item label="图片" prop="url">
            <img :src="imgDataUrl">
            <el-button type="primary" class="uploadBtn" icon="el-icon-upload" round @click="toggleShow">上传</el-button>
        </el-form-item>

		<el-form-item label="标签" prop="tag_id">
		  <el-select v-model="form.tag_id" placeholder="选择标签" style="width: 100%">
		    <el-option v-for="tag in tags" :label="tag.name" :value="tag.id" :key="tag.id"></el-option>
		  </el-select>
		</el-form-item>

		<el-form-item label="描述" prop="desc">
          <el-input v-model="form.desc"></el-input>
		</el-form-item>

		<el-form-item label="排序" prop="order">
		  <el-col>
		  	<el-input type="number" v-model="form.order"></el-input>
		  </el-col>
		</el-form-item>

		<el-form-item>
            <el-button type="success" @click="submitForm('form')" size="small">保存</el-button>
            <el-button @click="backPictureList" size="small">取消</el-button>
		</el-form-item>
    </el-form>

	<my-upload field="file"
        @crop-success="cropSuccess"
        @crop-upload-success="cropUploadSuccess"
        @crop-upload-fail="cropUploadFail"
        v-model="show"
		:width="400"
        :height="400"
        :noCircle="true"
        langType="en"
        url="api/v1/backend/picture/getUploadPath"
		:params="params"
		:headers="headers"
		img-format="png">
	</my-upload>
    </div>
    </div>
  </div>
</template>

<script>
    import myUpload from 'vue-image-crop-upload'
    import ApiList from './../../config.js'
    import { getHttpHeader } from './../../utils/util.js'
    import { http } from './../../utils/fetch.js'

    export default {
    components: {
        'my-upload': myUpload
    },
    data() {
        return {
            show: false,
            params: {
            },
            headers: getHttpHeader(),
            imgDataUrl: '',
            tags: [],
            form: {
              user_id: '',
              tag_id: '',
              desc: '',
              order: 1,
              url: '' 
            },
            rules: {
              url: [
                { required: true, message: '图片路径', trigger: 'blur' },
              ],
              tag_id: [
                { required: true, message: '标签', trigger: 'change' }
              ],
              order: [
                { required: true, message: '请排序', trigger: 'change' }
              ],
              desc: [
                { required: true, message: '图片描述', trigger: 'change' }
              ]
            }
        }
    },

    created() {
        this.fetchUserTag()
    },

    methods: {
        toggleShow() {
            this.show = !this.show;
        },

	    fetchUserTag() {
	      http({
	      	url: ApiList.getUserTagUrl,
	      	method: 'get',
	      }).then(response => {
              this.tags = response.data.data
	      }, response => {
	      	console.log("fetch data error")
	      })
	    },

	    backPictureList() {
	      this.$router.push('/picture/user')
	    },

        submitForm(formName) {
          this.$refs[formName].validate((valid) => {
            if (valid) {
	      	http({
	      	  url: ApiList.storePictureUrl,
	      	  method: 'post',
	      	  data: this.form
	      	}).then(response => {
	      	  if (response.data.code == 200) {
                    this.$notify({
                        type: 'success',
                        message: this.$i18n.t("common.createSuccess")
                    });
	      		  this.$router.push('/picture/user')
	      	  }
	      	}, response => {
	      	  console.log("fetch data error")
	      	})
            } else {
              return false;
            }
          });
        },

        /**
        * crop success
        *
        * [param] imgDataUrl
        * [param] field
        */
        cropSuccess(imgDataUrl, field){
            this.imgDataUrl = imgDataUrl;
        },

        /**
        * upload success
        *
        * [param] jsonData  server api return data, already json encode
        * [param] field
        */
        cropUploadSuccess(jsonData, field){
            if (jsonData.code == 200) {
                this.form.url = jsonData.data
            }
        },
        /**
        * upload fail
        *
        * [param] status    server api return error status, like 500
        * [param] field
        */
        cropUploadFail(status, field){
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
  .uploadBtn {
      margin-left: 30px;
  }
  .demo-form {
	width: 600px;
    margin: 30px auto;
  }
</style>
