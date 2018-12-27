<template>
    <div class="box box-warning shopOpeningTime">
        <div class="box-body" style="margin: 0 auto">
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

		  <el-form-item label="价格" prop="price">
            <el-input v-model="form.price"></el-input>
		  </el-form-item>

		  <el-form-item label="数量" prop="count">
			<el-col :span="6">
				<el-input type="number" v-model="form.count"></el-input>
			</el-col>
		  </el-form-item>

		  <el-form-item>
              <el-button type="success" @click="submitForm('form')" size="small">保存</el-button>
              <el-button @click="backMenuAdditionList" size="small">取消</el-button>
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
        menus: [],
        form: {
          name: '',
          menu_id: '',
          price: 0,
          count: 1,
        },
        rules: {
          name: [
            { required: true, message: '名称', trigger: 'blur' },
          ],
          menu_id: [
            { required: true, message: '请选择菜品', trigger: 'change' }
          ],
          count: [
            { required: true, message: '请输入数量', trigger: 'change' }
          ],
          price: [
            { required: true, message: '请输入价格', trigger: 'change' }
          ]
        }
      };
    },

    created() {
        this.fetchUserMenu()
        this.fetchMenuAdditionData()
    },

    methods: {

      fetchMenuAdditionData() {
		http({
			url: ApiList.getMenuAdditionDetailUrl + this.$route.params.id,
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
			  url: ApiList.updateMenuAdditionUrl + this.$route.params.id,
			  method: 'put',
			  data: this.form
			}).then(response => {
			  if (response.data.code == 200) {
                  this.$notify({
                      type: 'success',
                      message: this.$i18n.t("common.createSuccess")
                  });
				  this.$router.push('/menuaddition/user')
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

	  backMenuAdditionList() {
		this.$router.push('/menuaddition/user')
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
