<template>
	<div>
		<el-form :model="form" :rules="rules" ref="form" label-width="100px" class="demo-form">
		  <el-form-item label="加菜" prop="name">
			<el-col :span="6">
				<el-input v-model="form.name"></el-input>
			</el-col>
		  </el-form-item>

		  <el-form-item label="菜品" prop="menu_id">
			<el-select v-model="form.menu_id" placeholder="选择菜品">
			  <el-option v-for="menu in menus" :label="menu.menu_name" :value="menu.id" :key="menu.id"></el-option>
			</el-select>
		  </el-form-item>

          <el-form-item label="介绍" prop="introduction">
            <el-input type="textarea" v-model="form.introduction"></el-input>
          </el-form-item>

		  <el-form-item>
              <el-button type="success" @click="submitForm('form')" size="small">保存</el-button>
              <el-button @click="backMenuOptionList" size="small">取消</el-button>
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
        menuTypes: [],
        form: {
          name: '',
          menu_id: '',
          introduction: '',
        },
        rules: {
          name: [
            { required: true, message: '名称', trigger: 'blur' },
          ],
          menu_id: [
            { required: true, message: '请选择上级菜单', trigger: 'change' }
          ],
          introduction: [
            { required: true, message: '请排序', trigger: 'change' }
          ]
        }
      };
    },

    created() {
        this.fetchUserMenu()
        this.fetchMenuOptionData()
    },

    methods: {

      fetchMenuOptionData() {
		http({
			url: ApiList.getMenuOptionDetailUrl + this.$route.params.id,
			method: 'get',
		}).then(response => {
			this.form = response.data.data
		}, response => {
			console.log("fetch data error")
		})
      },

      submitForm(formName) {
        this.$refs[formName].validate((valid) => {
          if (valid) {
			http({
			  url: ApiList.updateMenuOptionUrl + this.$route.params.id,
			  method: 'put',
			  data: this.form
			}).then(response => {
			  if (response.data.code == 200) {
                  this.$notify({
                      type: 'success',
                      message: this.$i18n.t("common.updateSuccess")
                  });
				  this.$router.push('/menuoption/user')
			  }
			}, response => {
			  console.log("fetch data error")
			})
          } else {
            return false;
          }
        });
      },

	  fetchUserMenu() {
		http({
			url: ApiList.getUserMenuUrl,
			method: 'get',
		}).then(response => {
            this.menus = response.data.data
		}, response => {
			console.log("fetch data error")
		})
	  },

	  backMenuOptionList() {
		this.$router.push('/menuoption/user')
	  },
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
