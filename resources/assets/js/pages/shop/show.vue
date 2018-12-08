<template>
	<div class="box box-info">
		<div class="box-header with-border">
			<h3 class="box-title">Edit</h3>
		</div>
		<el-row :gutter="20">
			<el-col :span="16" :offset="4">
				<div class="box-body">
					<el-form ref="form" :model="form" label-width="80px" >

					  <el-form-item label="ID">
						<el-input v-model="form.id"></el-input>
					  </el-form-item>

					  <el-form-item label="商家名称">
						<el-input v-model="form.restaurant_name"></el-input>
					  </el-form-item>

					  <el-form-item label="商家Logo">
						<el-upload
                          action="test"
                          :http-request="uploadShopImg"
						  list-type="picture-card"
						  :limit="1"
						  :on-preview="handleRestaurantLogoPreview"
						  :on-remove="handleRestaurantLogoRemove">
						  <i class="el-icon-plus" style="margin-top: 52px"></i>
						</el-upload>
						<el-dialog :visible.sync="dialogRestaurantLogoVisible">
						  <img width="100%" :src="dialogRestaurantLogoUrl" alt="">
						</el-dialog>
					  </el-form-item>

					  <el-form-item label="App商家Logo">
						<el-upload
						  action="https://jsonplaceholder.typicode.com/posts/"
						  list-type="picture-card"
						  :limit="1"
						  :on-preview="handleAppLogoPreview"
						  :on-remove="handleAppLogoRemove">
						  <i class="el-icon-plus" style="margin-top: 52px"></i>
						</el-upload>
						<el-dialog :visible.sync="dialogAppLogoVisible">
						  <img width="100%" :src="dialogAppLogoUrl" alt="">
						</el-dialog>
					  </el-form-item>

					  <el-form-item label="食物类别">
						<el-input v-model="form.food_type"></el-input>
					  </el-form-item>

					  <el-form-item label="税号">
						<el-input v-model="form.vat_reg_no"></el-input>
					  </el-form-item>

					  <el-form-item label="座机号">
						<el-input v-model="form.landline"></el-input>
					  </el-form-item>

					  <el-form-item label="邮箱">
						<el-input v-model="form.email"></el-input>
					  </el-form-item>

					  <el-form-item label="邮编">
						<el-input v-model="form.postcode"></el-input>
					  </el-form-item>

					  <el-form-item label="服务费">
						<el-input v-model="form.service_charge"></el-input>
					  </el-form-item>

					  <el-form-item label="城市">
						<el-input v-model="form.address"></el-input>
					  </el-form-item>

					  <el-form-item label="支付顺序">
						<el-input v-model="form.payment_sequence"></el-input>
					  </el-form-item>

					  <el-form-item label="详细照片">
						<el-upload
						  action="https://jsonplaceholder.typicode.com/posts/"
						  list-type="picture-card"
						  :limit="6"
						  :on-preview="handleRestaurantImagesPreview"
						  :on-remove="handleRestaurantImagesRemove">
						  <i class="el-icon-plus" style="margin-top: 52px"></i>
						</el-upload>
						<el-dialog :visible.sync="dialogRestaurantImagesVisible">
						  <img width="100%" :src="dialogRestaurantImagesUrl" alt="">
						</el-dialog>
					  </el-form-item>

					  <el-form-item>
						  <el-time-picker
							is-range
							v-model="value4"
							range-separator="至"
							start-placeholder="开始时间"
							end-placeholder="结束时间"
							placeholder="选择时间范围">
						  </el-time-picker>
					  </el-form-item>

					  <el-form-item>
						<el-button type="primary" @click="onSubmit">立即创建</el-button>
						<el-button>取消</el-button>
					  </el-form-item>
					</el-form>

				</div>
			</el-col>
		</el-row>
	</div>
</template>
<script>
  import { http } from './../../utils/fetch'
  import ApiList from './../../config'

  export default {
    data() {
      return {
        form: {
          id: '',
          restaurant_name: '',
          food_type: '',
          email: '',
          mobile: '',
          landline: '',
          address: '',
          postcode: ''
        },
        dialogRestaurantLogoUrl: '',
        dialogRestaurantLogoVisible: false,
        dialogAppLogoUrl: '',
        dialogAppLogoVisible: false,
        dialogRestaurantImagesUrl: '',
        dialogRestaurantImagesVisible: false,

        value4: [],
      }
    },

    created() {
        this.fetchShopData()
    },

    methods: {
      onSubmit() {
        console.log('submit!')
      },

      uploadShopImg (param) {

        let formData = new FormData()
        formData.append('file', param.file)

		http({
			url: ApiList.uploadShopImgUrl,
			method: 'post',
            data: formData
		}).then(response => {
            console.log(response.data)
		}, response => {
			console.log("fetch data error")
		})

      },

	  //处理商店Logo
      handleRestaurantLogoRemove(file, fileList) {
        console.log(file, fileList);
      },
      handleRestaurantLogoPreview(file) {
        this.dialogRestaurantLogoUrl = file.url;
		console.log(this.dialogRestaurantLogoUrl);
        this.dialogRestaurantLogoVisible = true;
      },

	  //处理商店详细
      handleRestaurantImagesRemove(file, fileList) {
        console.log(file, fileList);
      },
      handleRestaurantImagesPreview(file) {
        this.dialogRestaurantImagesUrl = file.url;
        this.dialogRestaurantImagesVisible = true;
      },

	  //处理AppLogo
      handleAppLogoPreview(file) {
        this.dialogAppLogoUrl = file.url;
		console.log(this.dialogAppLogoUrl);
        this.dialogAppLogoVisible = true;
      },
      handleAppLogoRemove(file, fileList) {
        console.log(file, fileList);
      },

      //获取店铺详细数据
      fetchShopData() {

		http({
			url: ApiList.getShopDetailUrl + this.$route.params.id,
			method: 'get',
		}).then(response => {
			this.form = response.data.data
            console.log(response.data)
		}, response => {
			console.log("fetch data error")
		})

      }
    }
  }
</script>

<style>
  .el-upload__input {
	display: none !important
  }
  .el-carousel__item h3 {
    color: #475669;
    font-size: 14px;
    opacity: 0.75;
    line-height: 200px;
    margin: 0;
  }
  .el-carousel__item:nth-child(2n) {
    background-color: #99a9bf;
  }
  .el-carousel__item:nth-child(2n+1) {
    background-color: #d3dce6;
  }
</style>
