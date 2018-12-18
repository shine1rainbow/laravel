<template>
	<div class="box box-info">
		<div class="box-header with-border">
			<h3 class="box-title">Edit</h3>
		</div>
		<el-row :gutter="20">
			<el-col :span="16" :offset="4">
				<div class="box-body">
					<el-form ref="form" :model="form" label-width="80px" >

					  <el-form-item label="商家名称">
						<el-input v-model="form.restaurant_name"></el-input>
					  </el-form-item>

					  <el-form-item label="商家Logo">
                          <img :src="form.restaurant_background" id="restaurant_background_img">
					  </el-form-item>

					  <el-form-item label="App商家Logo">
                          <img :src="form.restaurant_logo" id="restaurant_logo_img">
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
                        <el-row>
                          <el-col :span="8" v-for="(image,index) in form.images" :key="index" :offset="index > 0 ? 2 : 0">
                            <el-card :body-style="{ padding: '0px' }">
                              <img :src="image" class="restaurant_image_img">
                            </el-card>
                          </el-col>
                        </el-row>
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
                        <el-button size="small" type="success" @click="onSubmit('form')">更新</el-button>
				        <el-button size="small" @click="backUserShopList">取消</el-button>
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
          restaurant_background: '',
          restaurant_logo: '',
          food_type: '',
          email: '',
          mobile: '',
          landline: '',
          address: '',
          postcode: '',
          images: [] 
        },

        value4: [],
      }
    },

    created() {
        this.fetchShopData()
    },

    methods: {

      onSubmit(formName) {
        this.$refs[formName].validate((valid) => {
          if (valid) {
			http({
			  url: ApiList.updateShopUrl + this.$route.params.id,
			  method: 'put',
			  data: this.form
			}).then(response => {
			  if (response.data.code == 200) {
                  this.$notify({
                      type: 'success',
                      message: this.$i18n.t("common.updateSuccess")
                  });
				  this.$router.push('/shop/user')
			  }
			}, response => {
			  console.log("fetch data error")
			})
          } else {
            return false;
          }
        });
      },

	  backUserShopList() {
		this.$router.push('/shop/user')
	  },

      //获取店铺详细数据
      fetchShopData() {

		http({
			url: ApiList.getShopDetailUrl + this.$route.params.id,
			method: 'get',
		}).then(response => {
			this.form = response.data.data
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
  #restaurant_background_img {
    width: 200px;
    height: 200px;
  }
  #restaurant_logo_img {
    width: 200px;
    height: 200px;
  }
  .restaurant_image_img {
    width: 300px;
    height: 300px;
  }
</style>
