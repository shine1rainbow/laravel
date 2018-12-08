<template>
	<div>
        <div class="step-header">
            <el-steps :active="active" finish-status="success">
              <el-step title="添加店铺基础信息"></el-step>
              <el-step title="上传LOGO"></el-step>
              <el-step title="上传背景LOGO"></el-step>
              <el-step title="商店介绍图"></el-step>
            </el-steps>
        </div>

        <!--添加店铺基础信息-->
        <div v-if="active == 0">
            <div class="box box-info basicInfo">
                <el-row :gutter="20">
                    <el-col :span="16" :offset="4">
                        <div class="box-body">
                            <el-form ref="form" :rules="rules" :model="form" label-width="80px" >

                              <el-form-item label="商家名称" prop="restaurant_name">
                                <el-input v-model="form.restaurant_name"></el-input>
                              </el-form-item>

                              <el-form-item label="食物类别" prop="food_type">
                                <el-input v-model="form.food_type"></el-input>
                              </el-form-item>

                              <el-form-item label="邮箱" prop="email">
                                <el-input v-model="form.email"></el-input>
                              </el-form-item>

                              <el-form-item label="手机号" prop="mobile">
                                <el-input v-model="form.mobile"></el-input>
                              </el-form-item>

                              <el-form-item label="座机号" prop="landline">
                                <el-input v-model="form.landline"></el-input>
                              </el-form-item>

                              <el-form-item label="城市" prop="address">
                                <el-input v-model="form.address"></el-input>
                              </el-form-item>

                              <el-form-item label="邮编" prop="postcode">
                                <el-input v-model="form.postcode"></el-input>
                              </el-form-item>

                              <el-form-item label="服务费" prop="service_charge">
                                <el-input v-model="form.service_charge"></el-input>
                              </el-form-item>

                              <el-form-item label="支付顺序" prop="payment_sequence">
                                <el-input v-model="form.payment_sequence"></el-input>
                              </el-form-item>

							  <el-form-item label="税号" prop="vat_reg_no">
                                <el-input v-model="form.vat_reg_no"></el-input>
                              </el-form-item>

                              <el-form-item label="介绍" prop="introduction">
                                <el-input type="textarea" v-model="form.introduction"></el-input>
                              </el-form-item>

                              <el-form-item label="温馨提示" prop="remind">
                                <el-input type="textarea" v-model="form.remind"></el-input>
                              </el-form-item>

                              <el-form-item label="活动" prop="activity">
                                <el-input type="textarea" v-model="form.activity"></el-input>
                              </el-form-item>

                              <el-form-item label="店铺状态" prop="shop_status_id">
								  <el-select v-model="form.shop_status_id" placeholder="请选择">
									<el-option
									  v-for="shopStatus in shopStatuses"
									  :key="shopStatus.id"
									  :label="shopStatus.name"
									  :value="shopStatus.id">
									</el-option>
								  </el-select>
                              </el-form-item>

                              <el-form-item>
                                <div style="text-align: center">
                                    <el-button 
										icon="el-icon-circle-close-outline"
										type="primary"
										size="small"
										@click="backUserShopList"
									>取消</el-button>
									<el-button
										icon="el-icon-arrow-right"
										type="success"
										@click="storeShopBasicInfo"
										size="small"
									>添加餐厅</el-button>
                                </div>
                              </el-form-item>
                            </el-form>
                        </div>
                    </el-col>
                </el-row>
            </div>
        </div>

        <!--上传logo-->
        <div v-else-if="active == 1">
            <div style="margin: 20px auto; text-align: center">
              <el-upload
				  ref="uploadRestaurantLogo"
                  action="test"
                  :http-request="uploadRestaurantLogoImg"
                  list-type="picture-card"
                  :limit="1"
                  :on-preview="handleRestaurantLogoPreview"
                  :on-remove="handleRestaurantLogoRemove">
                  <i class="el-icon-plus" style="margin-top: 52px"></i>
              </el-upload>
              <el-dialog :visible.sync="dialogRestaurantLogoVisible">
                  <img width="100%" :src="dialogRestaurantLogoUrl" alt="">
              </el-dialog>

              <el-button style="margin-top: 12px;" @click="pre">上一步</el-button>
              <el-button type="primary" style="margin-top: 12px;" @click="next">下一步</el-button>
            </div>
        </div>

        <!--上传logo-->
        <div v-else-if="active == 2">
            <div style="margin: 20px auto; text-align: center">
                <el-upload
				  ref="uploadAppLogo"
                  action="test"
                  :http-request="uploadAppLogoImg"
                  :show-file-list="false"
                  list-type="picture-card"
                  :on-preview="handleAppLogoPreview"
                  :on-remove="handleAppLogoRemove">
                  <i class="el-icon-plus" style="margin-top: 52px"></i>
                </el-upload>
                <el-dialog :visible.sync="dialogAppLogoVisible">
                  <img width="100%" :src="dialogAppLogoUrl" alt="">
                </el-dialog>
                <el-button style="margin-top: 12px;" @click="pre">上一步</el-button>
                <el-button type="primary" style="margin-top: 12px;" @click="next">下一步</el-button>
            </div>
        </div>

        <!--上传商店介绍图-->
        <div v-else="active == 3">
            <div style="margin: 20px auto; text-align: center">
				<el-upload
				  ref="uploadRestaurantImages"
				  action="test"
				  :http-request="uploadRestaurantImages"
				  list-type="picture-card"
				  :limit="6"
				  :on-preview="handleRestaurantImagesPreview"
				  :on-remove="handleRestaurantImagesRemove">
				  <i class="el-icon-plus" style="margin-top: 52px"></i>
				</el-upload>
				<el-dialog :visible.sync="dialogRestaurantImagesVisible">
				  <img width="100%" :src="dialogRestaurantImagesUrl" alt="">
				</el-dialog>
			  <el-button style="margin-top: 12px;" @click="backUserShopList">取消</el-button>
			  <el-button style="margin-top: 12px;" @click="backUserShopList">完成</el-button>
			</div>
        </div>
	</div>
</template>

<script>
  import { http } from './../../utils/fetch'
  import ApiList from './../../config'

  export default {
    data() {
      return {
        active: 1,
        form: {
          restaurant_name: '',
          food_type: '',
          email: '',
          mobile: '',
          landline: '',
          address: '',
          postcode: '',
          service_charge: '',
          payment_sequence: '',
          vat_reg_no: '',
          introduction: '',
          remind: '',
          activity: '',
          shop_status_id: '' 
        },
        rules: {
          restaurant_name: [
            { required: true, message: '请输入餐厅名称', trigger: 'blur' }
          ],
          food_type: [
            { required: true, message: '请输入食物类型', trigger: 'blur' }
          ],
          email: [
            { required: true, message: '请输入邮件', trigger: 'blur' }
          ],
          mobile: [
            { required: true, message: '手机号', trigger: 'blur' }
          ],
          landline: [
            { required: true, message: '座机', trigger: 'blur' }
          ],
          service_charge: [
            { required: true, message: '服务费', trigger: 'blur' }
          ],
          address: [
            { required: true, message: '地址', trigger: 'blur' }
          ],
          postcode: [
            { required: true, message: '邮编', trigger: 'blur' }
          ],
          shop_status_id: [
            { required: true, message: '餐厅状态', trigger: 'blur' }
          ],
          payment_sequence: [
            { required: true, message: '支付方式', trigger: 'blur' }
          ],
          vat_reg_no: [
            { required: true, message: '税号', trigger: 'blur' }
          ],
          remain: [
            { message: '温馨提示', trigger: 'blur' }
          ],
          introduction: [
            { required: true, message: '介绍', trigger: 'blur' }
          ]
        },
		shop_id: '',
		restaurant_logo: '',
		restaurant_background: '',
		business_hour: {},
		images: '',
		shopStatuses: [],
        dialogRestaurantLogoUrl: '',
        dialogRestaurantLogoVisible: false,
        dialogAppLogoUrl: '',
        dialogAppLogoVisible: false,
        dialogRestaurantImagesUrl: '',
        dialogRestaurantImagesVisible: false
      };
    },

	created() {
		this.fetchShopStatuses()
this.shop_id=11;
	},

    methods: {

	  fetchShopStatuses() {
		http({
			url: ApiList.getShopStatusListUrl,
			method: 'get',
		}).then(response => {
            this.shopStatuses = response.data.data
		}, response => {
			console.log("fetch data error")
		})
	  },

      next() {
        this.active++
      },

      pre() {
        this.active--
      },

      //保存店铺基本信息
      storeShopBasicInfo() {

        this.$refs['form'].validate((valid) => {
          if (valid) {

			http({
				url: ApiList.storeShopUrl,
				method: 'post',
				data: this.form
			}).then(response => {
				if (response.status == 200) {
					this.shop_id = response.data.data
					this.next()
				}
			}, response => {
				console.log("fetch data error")
			})

          } else {
            return false;
          }
        });

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

      uploadRestaurantLogoImg (param) {

        let formData = new FormData()
        formData.append('file', param.file)
        formData.append('id', this.shop_id)
        formData.append('type', 'restaurant_logo')

		http({
			url: ApiList.uploadShopImgUrl,
			method: 'post',
            data: formData
		}).then(response => {
			if (response.data.code == 200) {
				this.next()
			}
		}, response => {
			console.log("fetch data error")
		})

      },

      uploadAppLogoImg (param) {

        let formData = new FormData()
        formData.append('id', this.shop_id)
        formData.append('file', param.file)
        formData.append('type', 'restaurant_background')

		http({
			url: ApiList.uploadShopImgUrl,
			method: 'post',
            data: formData
		}).then(response => {
				this.active++
			if (response.data.code == 200) {
				this.next()
			}
		}, response => {
			console.log("fetch data error")
		})

      },

      uploadRestaurantImages (param) {

        let formData = new FormData()
        formData.append('id', this.shop_id)
        formData.append('file', param.file)
        formData.append('type', 'images')

		http({
			url: ApiList.uploadShopImgUrl,
			method: 'post',
            data: formData
		}).then(response => {
		}, response => {
			console.log("fetch data error")
		})

      },

	  backUserShopList() {
		this.$router.push('/shop/user')
	  }
    }
  }
</script>

<style>
  .step-header {
      margin: 10px;
  }
  .el-upload__input {
	display: none !important
  }
  .basicInfo {
	margin-top: 20px;
  }
</style>
