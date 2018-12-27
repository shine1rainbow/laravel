<template>
    <div class="box box-warning shopOpeningTime">
        <div class="box-body" style="margin: 0 auto">
		<el-form :model="form" :rules="rules" ref="form" label-width="100px" class="demo-form">
		  <el-form-item label="菜单名称" prop="name">
            <el-input v-model="form.name"></el-input>
		  </el-form-item>

		  <el-form-item label="店铺" prop="shop_id">
			<el-select v-model="form.shop_id" placeholder="选择店铺">
			  <el-option v-for="shop in shops" :label="shop.restaurant_name" :value="shop.id" :key="shop.id"></el-option>
			</el-select>
		  </el-form-item>

		  <el-form-item label="开放时间" prop="working_date">
			<el-checkbox-group v-model="workingDate" @change="handleCheckedWorkingDateChange">
				<el-checkbox v-for="weekend in weekends" :label="weekend.id" :key="weekend.id">{{weekend.name}}</el-checkbox>
			</el-checkbox-group>
		  </el-form-item>

		  <el-form-item label="开业时间" required>
			<el-time-picker
				is-range
				v-model="opening_time"
				range-separator="至"
				start-placeholder="开始时间"
				end-placeholder="结束时间"
				placeholder="选择时间范围"
				@change="pickOpeningTime"
			>
			</el-time-picker>
		  </el-form-item>

		  <el-form-item label="服务时间" required>
			<el-time-picker
				is-range
				v-model="serving_time"
				range-separator="至"
				start-placeholder="开始时间"
				end-placeholder="结束时间"
				placeholder="选择时间范围"
				@change="pickServingTime"
			>
			</el-time-picker>
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
              <el-button @click="backMenuTypeList" size="small">取消</el-button>
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
        shops: [],
		workingDate: [],
		weekends: [
			{id: 1, name: '周一'},
			{id: 2, name: '周二'},
			{id: 3, name: '周三'},
			{id: 4, name: '周四'},
			{id: 5, name: '周五'},
			{id: 6, name: '周六'},
			{id: 7, name: '周日'},
		],
		opening_time: [new Date(2018, 9, 18, 7, 0), new Date(2018, 9, 18, 18, 0)],
		serving_time: [new Date(2018, 9, 18, 8, 0), new Date(2018, 9, 18, 18, 0)],
        form: {
          name: '',
          shop_id: '',
		  working_date: '',
		  opening_time: '07:00:00,18:00:00',
		  serving_time: '08:00:00,18:00:00',
          is_recommend: false,
          is_hot: false,
        },
        rules: {
          name: [
            { required: true, message: '名称', trigger: 'blur' },
          ],
          shop_id: [
            { required: true, message: '请选择店铺', trigger: 'change' }
          ],
          working_date: [
            { required: true, message: '请开放时间', trigger: 'blur' }
          ],
          opening_time: [
            { required: true, message: '请选择日期', trigger: 'change' }
          ],
          serving_time: [
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

	computed: {
		formatOpeningTime: function () {
			return parseTime(this.opening_time[0], "{h}:{i}:{s}") + "," + 
				parseTime(this.opening_time[1], "{h}:{i}:{s}")
		},

		formatServingTime: function () {
			return parseTime(this.opening_time[0], "{h}:{i}:{s}") + "," + 
				parseTime(this.opening_time[1], "{h}:{i}:{s}")
		}
	},

    created() {
        this.fetchUserShop()
    },

    methods: {

      submitForm(formName) {
        this.$refs[formName].validate((valid) => {
          if (valid) {
			http({
			  url: ApiList.storeMenuTypeUrl,
			  method: 'post',
			  data: this.form
			}).then(response => {
			  if (response.data.code == 200) {
                  this.$notify({
                      type: 'success',
                      message: this.$i18n.t("common.createSuccess")
                  });
				  this.$router.push('/menutype/user')
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

	  pickOpeningTime() {
		this.form.opening_time = this.formatOpeningTime
	  },

	  pickServingTime() {
		this.form.serving_time = this.formatServingTime
	  },

	  backMenuTypeList() {
		this.$router.push('/menutype/user')
	  },

	  handleCheckedWorkingDateChange(value) {
		this.form.working_date = value.toString()
	  }
    }
  }
</script>

<style scoped>
  .el-switch, .el-checkbox-group {
	margin: 10px;
  }
  .demo-form {
	width: 750px;
    margin: 30px auto;
  }
</style>
