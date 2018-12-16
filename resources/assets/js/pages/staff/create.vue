<template>
	<div >
		<el-form :model="form" :rules="rules" ref="form" label-width="100px" class="demo-form">
		  <el-form-item label="昵称" prop="nickname">
			<el-col :span="6">
				<el-input v-model="form.nickname"></el-input>
			</el-col>
		  </el-form-item>

		  <el-form-item label="姓" prop="first_name">
			<el-col :span="6">
				<el-input v-model="form.first_name"></el-input>
			</el-col>
		  </el-form-item>

		  <el-form-item label="名" prop="last_name">
			<el-col :span="6">
				<el-input v-model="form.last_name"></el-input>
			</el-col>
		  </el-form-item>

		  <el-form-item label="手机号" prop="phone">
			<el-col :span="6">
				<el-input v-model="form.phone"></el-input>
			</el-col>
		  </el-form-item>

		  <el-form-item label="职位" prop="position">
			<el-col :span="6">
				<el-input v-model="form.position"></el-input>
			</el-col>
		  </el-form-item>

		  <el-form-item label="操作" prop="actions">
			<el-col :span="6">
				<el-input v-model="form.actions"></el-input>
			</el-col>
		  </el-form-item>

		  <el-form-item label="年龄" prop="age">
			<el-col :span="6">
				<el-input v-model="form.age"></el-input>
			</el-col>
		  </el-form-item>

		  <el-form-item label="性别" prop="gender">
			<el-select v-model="form.gender" placeholder="性别">
			  <el-option label="男" value="1"></el-option>
			  <el-option label="女" value="0"></el-option>
			</el-select>
		  </el-form-item>

		  <el-form-item label="店铺" prop="shop_id">
			<el-select v-model="form.shop_id" placeholder="选择店铺">
			  <el-option v-for="shop in shops" :label="shop.restaurant_name" :value="shop.id" :key="shop.id"></el-option>
			</el-select>
		  </el-form-item>

		  <el-form-item>
              <el-button type="success" @click="submitForm('form')" size="small">保存</el-button>
              <el-button @click="backStaffList" size="small">取消</el-button>
		  </el-form-item>
		</el-form>
	</div>
</template>

<script>
  import { http } from './../../utils/fetch'
  import { parseTime } from './../../utils/util'
  import ApiList from './../../config'

  export default {
    data() {
      return {
        shops: [],
        form: {
          shop_id: '',
		  nickname: '',
		  first_name: '',
		  last_name: '',
          position: '',
          actions: '',
          avater: '',
          age: '',
          phone: '',
          gender: '',
        },
        rules: {
          nickname: [
            { required: true, message: '昵称', trigger: 'blur' },
          ],
          first_name: [
            { required: true, message: '姓', trigger: 'blur' },
          ],
          last_name: [
            { required: true, message: '名', trigger: 'blur' },
          ],
          shop_id: [
            { required: true, message: '请选择店铺', trigger: 'change' }
          ],
          position: [
            { required: true, message: '职位', trigger: 'blur' }
          ],
          actions: [
            { required: true, message: '操作', trigger: 'blur' }
          ],
          phone: [
            { required: true, message: '手机号', trigger: 'change' }
          ],
          avater: [
            { required: true, message: '头像', trigger: 'change' }
          ],
          age: [
            { required: true, message: '年龄', trigger: 'change' }
          ],
          gender: [
            { required: true, message: '性别', trigger: 'change' }
          ],
        }
      };
    },

    created() {
        this.fetchUserShop()
    },

    methods: {

      submitForm(formName) {
        this.$refs[formName].validate((valid) => {
          if (valid) {
			http({
			  url: ApiList.storeStaffUrl,
			  method: 'post',
			  data: this.form
			}).then(response => {
			  if (response.data.code == 200) {
                  this.$notify({
                      type: 'success',
                      message: this.$i18n.t("common.createSuccess")
                  });
				  this.$router.push('/staff/user')
			  }
			}, response => {
			  console.log("fetch data error")
			})
          } else {
            return false;
          }
        });
      },

	  fetchUserShop() {
		http({
			url: ApiList.getUserShopUrl,
			method: 'get',
		}).then(response => {
            this.shops = response.data.data
		}, response => {
			console.log("fetch data error")
		})
	  },

	  backStaffList() {
		this.$router.push('/staff/user')
	  }
    }
  }
</script>

<style scoped>
  .el-switch, .el-checkbox-group {
	margin: 10px;
  }
  .demo-roleForm {
	width: 500px;
  }
</style>
