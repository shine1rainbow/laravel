<template>
    <div class="box box-warning shopOpeningTime">
        <div class="box-body" style="margin: 0 auto">
		<el-form :model="form" :rules="rules" ref="form" label-width="100px" class="demo-form">

		  <el-form-item label="图片" prop="url">
            <img :src="form.url" alt="picture" style="width: 250px;height: 250px">
		  </el-form-item>

		  <el-form-item label="描述" prop="desc">
            <el-input v-model="form.desc"></el-input>
		  </el-form-item>

		  <el-form-item label="排序" prop="order">
            <el-input type="number" v-model="form.order"></el-input>
		  </el-form-item>

		  <el-form-item label="标签" prop="tag_id">
			<el-select v-model="form.tag_id" placeholder="选择标签" style="width: 100%">
			  <el-option v-for="tag in tags" :label="tag.name" :value="tag.id" :key="tag.id"></el-option>
			</el-select>
		  </el-form-item>

		  <el-form-item>
              <el-button type="success" @click="submitForm('form')" size="small">保存</el-button>
              <el-button @click="backPictureList" size="small">取消</el-button>
		  </el-form-item>
		</el-form>
	</div>
    </div>
</template>

<script>
  import { http } from './../../utils/fetch'
  import ApiList from './../../config'

  export default {
    data() {
      return {
        tags: [],
        form: {
          user_id: '',
          tag_id: '',
          desc: '',
          order: '',
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
      };
    },

    created() {
        this.fetchUserTag()
        this.fetchPictureData()
    },

    methods: {

      //获取图片
      fetchPictureData() {

          http({
              url: ApiList.getPictureDetailUrl + this.$route.params.id,
              method: 'get',
          }).then(response => {
              this.form = response.data.data
          }, response => {
              console.log("fetch data error")
          })
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

      submitForm(formName) {
        this.$refs[formName].validate((valid) => {
          if (valid) {
			http({
			  url: ApiList.updatePictureUrl + this.$route.params.id,
			  method: 'put',
			  data: this.form
			}).then(response => {
			  if (response.data.code == 200) {
                  this.$notify({
                      type: 'success',
                      message: this.$i18n.t("common.updateSuccess")
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

	  backPictureList() {
		this.$router.push('/picture/user')
	  },
    }
  }
</script>

<style scoped>
  .el-switch, .el-checkbox-group {
	margin: 10px;
  }
  .demo-form {
	width: 600px;
    margin: 30px auto;
  }
</style>
