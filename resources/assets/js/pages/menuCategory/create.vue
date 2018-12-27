<template>
    <div class="box box-warning shopOpeningTime">
        <div class="box-body" style="margin: 0 auto">
		<el-form :model="form" :rules="rules" ref="form" label-width="100px" class="demo-form">
		  <el-form-item label="菜单名称" prop="name">
			<el-col :span="6">
				<el-input v-model="form.name"></el-input>
			</el-col>
		  </el-form-item>

		  <el-form-item label="一级菜单" prop="menu_type_id">
			<el-select v-model="form.menu_type_id" placeholder="选择一级菜单">
			  <el-option v-for="menuType in menuTypes" :label="menuType.name" :value="menuType.id" :key="menuType.id"></el-option>
			</el-select>
		  </el-form-item>

          <el-form-item label="介绍" prop="introduction">
            <el-input type="textarea" v-model="form.introduction"></el-input>
          </el-form-item>

		  <el-form-item label="排序" prop="order">
			<el-col :span="6">
				<el-input type="number" v-model="form.order"></el-input>
			</el-col>
		  </el-form-item>

		  <el-form-item label="是否热搜" required>
			<el-switch
				v-model="form.is_hot"
				active-color="#13ce66"
				inactive-color="#ff4949"
				active-value="1"
				inactive-value="0">
			</el-switch>
		  </el-form-item>

		  <el-form-item label="是否推荐" required>
			<el-switch
				v-model="form.is_recommend"
				active-color="#13ce66"
				inactive-color="#ff4949"
				active-value="1"
				inactive-value="0">
			</el-switch>
		  </el-form-item>

		  <el-form-item>
              <el-button type="success" @click="submitForm('form')" size="small">保存</el-button>
              <el-button @click="backMenuCategoryList" size="small">取消</el-button>
		  </el-form-item>
		</el-form>
	</div>
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
          menu_type_id: '',
          order: 1,
          introduction: '',
          is_recommend: false,
          is_hot: false,
        },
        rules: {
          name: [
            { required: true, message: '名称', trigger: 'blur' },
          ],
          menu_type_id: [
            { required: true, message: '请选择上级菜单', trigger: 'change' }
          ],
          order: [
            { required: true, message: '请排序', trigger: 'change' }
          ],
          introduction: [
            { required: true, message: '请选择时间', trigger: 'change' }
          ],
          is_hot: [
            { required: true, message: '是否热搜', trigger: 'change' }
          ],
          is_recommend: [
            { required: true, message: '是否推荐', trigger: 'change' }
          ]
        }
      };
    },

    created() {
        this.fetchUserMenuType()
    },

    methods: {

      submitForm(formName) {
        this.$refs[formName].validate((valid) => {
          if (valid) {
			http({
			  url: ApiList.storeMenuCategoryUrl,
			  method: 'post',
			  data: this.form
			}).then(response => {
			  if (response.data.code == 200) {
                  this.$notify({
                      type: 'success',
                      message: this.$i18n.t("common.createSuccess")
                  });
				  this.$router.push('/menucategory/user')
			  }
			}, response => {
			  console.log("fetch data error")
			})
          } else {
            return false;
          }
        });
      },

	  fetchUserMenuType() {
		http({
			url: ApiList.getUserMenuTypeUrl,
			method: 'get',
		}).then(response => {
            this.menuTypes = response.data.data
		}, response => {
			console.log("fetch data error")
		})
	  },

	  backMenuCategoryList() {
		this.$router.push('/menucategory/user')
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
