<template>
	<div>
		<el-form :model="form" :rules="rules" ref="form" label-width="100px" class="demo-form">
		  <el-form-item label="菜单名称" prop="menu_name">
			<el-col :span="6">
				<el-input v-model="form.menu_name"></el-input>
			</el-col>
		  </el-form-item>

		  <el-form-item label="二级菜单" prop="menu_category_id">
			<el-select v-model="form.menu_category_id" placeholder="选择二级菜单">
			  <el-option v-for="menuCategory in menuCategories" :label="menuCategory.name" :value="menuCategory.id" :key="menuCategory.id"></el-option>
			</el-select>
		  </el-form-item>

		  <el-form-item label="菜单号" prop="menu_no">
            <el-input v-model="form.menu_no"></el-input>
		  </el-form-item>

		  <el-form-item label="价格" prop="price">
            <el-input v-model="form.price"></el-input>
		  </el-form-item>

		  <el-form-item label="数量" prop="number">
			<el-col :span="6">
				<el-input type="number" v-model="form.number"></el-input>
			</el-col>
		  </el-form-item>

		  <el-form-item label="辣度" prop="spicy">
			<el-col :span="6">
				<el-input type="number" v-model="form.spicy"></el-input>
			</el-col>
		  </el-form-item>

		  <el-form-item label="排序" prop="order">
			<el-col :span="6">
				<el-input type="number" v-model="form.order"></el-input>
			</el-col>
		  </el-form-item>

		  <el-form-item label="是否有货" required>
			<el-switch
				v-model="form.status"
				active-color="#13ce66"
				inactive-color="#ff4949"
				active-value="1"
				inactive-value="0">
			</el-switch>
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

          <el-form-item label="介绍" prop="introduction">
            <el-input type="textarea" v-model="form.introduction"></el-input>
          </el-form-item>

		  <el-form-item>
              <el-button type="success" @click="submitForm('form')" size="small">保存</el-button>
              <el-button @click="backMenuList" size="small">取消</el-button>
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
        menuCategories: [],
        form: {
          menu_name: '',
          menu_no: '',
          menu_category_id: '',
          order: 1,
          spicy: 0,
          price: 0.00,
          number: 0,
          status: 1,
          introduction: '',
          is_recommend: false,
          is_hot: false,
        },
        rules: {
          menu_name: [
            { required: true, message: '菜单名', trigger: 'blur' },
          ],
          menu_no: [
            { required: true, message: '菜单号', trigger: 'blur' },
          ],
          menu_category_id: [
            { required: true, message: '所属类别', trigger: 'change' }
          ],
          order: [
            { required: true, message: '请排序', trigger: 'change' }
          ],
          spicy: [
            { required: true, message: '辣度', trigger: 'change' }
          ],
          number: [
            { required: true, message: '数量', trigger: 'change' }
          ],
          price: [
            { required: true, message: '价格', trigger: 'change' }
          ],
          status: [
            { required: true, message: '有货/无货', trigger: 'change' }
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
        this.fetchUserMenuCategory()
    },

    methods: {

      submitForm(formName) {
        this.$refs[formName].validate((valid) => {
          if (valid) {
			http({
			  url: ApiList.storeMenuUrl,
			  method: 'post',
			  data: this.form
			}).then(response => {
			  if (response.data.code == 200) {
                  this.$notify({
                      type: 'success',
                      message: this.$i18n.t("common.createSuccess")
                  });
				  this.$router.push('/menu/user')
			  }
			}, response => {
			  console.log("fetch data error")
			})
          } else {
            return false;
          }
        });
      },

	  fetchUserMenuCategory() {
		http({
			url: ApiList.getUserMenuCategoryUrl,
			method: 'get',
		}).then(response => {
            this.menuCategories = response.data.data
		}, response => {
			console.log("fetch data error")
		})
	  },

	  backMenuList() {
		this.$router.push('/menucategory/user')
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
