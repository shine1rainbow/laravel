<template>
	<div>
        <div class="step-header">
            <el-steps :active="active" finish-status="success">
              <el-step title="添加店铺基础信息"></el-step>
              <el-step title="设置营业时间"></el-step>
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
                                <el-input placeholder="10%" v-model="form.service_charge"></el-input>
                              </el-form-item>

                              <el-form-item label="支付顺序" prop="payment_sequence">
								<el-select v-model="form.payment_sequence" placeholder="请选择" style="width: 100%">
                                  <el-option key="1" label="Before meal" value="before_meal"></el-option>
								  <el-option key="2" label="After meal" value="after_meal"></el-option>
								  <el-option key="3" label="Before meal2" value="before_meal2"></el-option>
								</el-select>
                              </el-form-item>

                              <el-form-item label="店铺状态" prop="shop_status_id">
								  <el-select v-model="form.shop_status_id" placeholder="请选择" style="width: 100%">
									<el-option
									  v-for="shopStatus in shopStatuses"
									  :key="shopStatus.id"
									  :label="shopStatus.name"
									  :value="shopStatus.id">
									</el-option>
								  </el-select>
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

        <div v-else-if="active == 1">
			<div class="box box-warning shopOpeningTime">
                <div class="box-body">
                    <el-row class="dayRow">
                        <el-col :span="2">
                            <h4>周一</h4>
                        </el-col>
                        <el-col :span="8">
                            <el-time-picker
                                is-range
                                v-model="monday_time"
                                @change="changeMonday"
                                range-separator="至"
                                start-placeholder="开始时间"
                                end-placeholder="结束时间"
                                placeholder="选择时间范围">
                            </el-time-picker>
                        </el-col>

                        <el-col :span="2" :offset="2">
                            <h4>周二</h4>
                        </el-col>
                        <el-col :span="8">
                            <el-time-picker
                                is-range
                                v-model="tuesday_time"
                                @change="changeTuesday"
                                range-separator="至"
                                start-placeholder="开始时间"
                                end-placeholder="结束时间"
                                placeholder="选择时间范围">
                            </el-time-picker>
                        </el-col>
                    </el-row>

                    <el-row class="dayRow">
                        <el-col :span="2">
                            <h4>周三</h4>
                        </el-col>
                        <el-col :span="8">
                            <el-time-picker
                                is-range
                                v-model="wednesday_time"
                                @change="changeWednesday"
                                range-separator="至"
                                start-placeholder="开始时间"
                                end-placeholder="结束时间"
                                placeholder="选择时间范围">
                            </el-time-picker>
                        </el-col>

                        <el-col :span="2" :offset="2">
                            <h4>周四</h4>
                        </el-col>
                        <el-col :span="8">
                            <el-time-picker
                                is-range
                                v-model="thursday_time"
                                @change="changeThursday"
                                range-separator="至"
                                start-placeholder="开始时间"
                                end-placeholder="结束时间"
                                placeholder="选择时间范围">
                            </el-time-picker>
                        </el-col>
                    </el-row>

                    <el-row class="dayRow">
                        <el-col :span="2">
                            <h4>周五</h4>
                        </el-col>
                        <el-col :span="8">
                            <el-time-picker
                                is-range
                                v-model="friday_time"
                                @change="changeFriday"
                                range-separator="至"
                                start-placeholder="开始时间"
                                end-placeholder="结束时间"
                                placeholder="选择时间范围">
                            </el-time-picker>
                        </el-col>

                        <el-col :span="2" :offset="2">
                            <h4>周六</h4>
                        </el-col>
                        <el-col :span="8">
                            <el-time-picker
                                is-range
                                v-model="saturday_time"
                                @change="changeSaturday"
                                range-separator="至"
                                start-placeholder="开始时间"
                                end-placeholder="结束时间"
                                placeholder="选择时间范围">
                            </el-time-picker>
                        </el-col>
                    </el-row>

                    <el-row class="dayRow">
                        <el-col :span="2">
                            <h4>周日</h4>
                        </el-col>
                        <el-col :span="8">
                            <el-time-picker
                                is-range
                                v-model="sunday_time"
                                @change="changeSunday"
                                range-separator="至"
                                start-placeholder="开始时间"
                                end-placeholder="结束时间"
                                placeholder="选择时间范围">
                            </el-time-picker>
                        </el-col>
                    </el-row>
                </div>

                <div style="text-align: center;">
                    <el-button
                        type="primary"
                        size="small"
                        style="margin-top: 12px;"
                        @click="pre"
                    >上一步
                    </el-button>
                    <el-button
                        type="success"
                        size="small"
                        style="margin-top: 12px; margin-bottom: 10px"
                        @click="updateBusinessHour"
                    >保存营业时间
                    </el-button>
                </div>
			</div>
        </div>

        <!--上传logo-->
        <div v-else-if="active == 2">
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

              <div style="text-align: center;">
                  <el-button type="primary" size="small" style="margin-top: 12px;" @click="pre">上一步</el-button>
                  <el-button type="success" size="small" style="margin-top: 12px;" @click="next">下一步</el-button>
              </div>
            </div>
        </div>

        <!--上传logo-->
        <div v-else-if="active == 3">
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
                <el-button type="primary" size="small" style="margin-top: 12px;" @click="pre">上一步</el-button>
                <el-button type="success" size="small" style="margin-top: 12px;" @click="next">下一步</el-button>
            </div>
        </div>

        <!--上传商店介绍图-->
        <div v-else="active == 4">
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
			  <el-button type="primary" size="small" style="margin-top: 12px;" @click="backUserShopList">取消</el-button>
			  <el-button type="success" size="small" style="margin-top: 12px;" @click="backUserShopList">完成</el-button>
			</div>
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
        active: 0,
        monday_time: [new Date(2016, 9, 10, 7, 0), new Date(2016, 9, 10, 18, 0)],
        tuesday_time: [new Date(2016, 9, 10, 7, 0), new Date(2016, 9, 10, 18, 0)],
        wednesday_time: [new Date(2016, 9, 10, 7, 0), new Date(2016, 9, 10, 18, 0)],
        thursday_time: [new Date(2016, 9, 10, 7, 0), new Date(2016, 9, 10, 18, 0)],
        friday_time: [new Date(2016, 9, 10, 7, 0), new Date(2016, 9, 10, 18, 0)],
        saturday_time: [new Date(2016, 9, 10, 7, 0), new Date(2016, 9, 10, 18, 0)],
        sunday_time: [new Date(2016, 9, 10, 7, 0), new Date(2016, 9, 10, 18, 0)],
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
          business_hour: {
            monday_time: "7:00,18:00",
            tuesday_time: "7:00,18:00",
            wednesday_time: "7:00,18:00",
            thursday_time: "7:00,18:00",
            friday_time: "7:00,18:00",
            saturday_time: "7:00,18:00",
            sunday_time: "7:00,18:00"
          },
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
          remaid: [
            { required: true, message: '温馨提示', trigger: 'blur' }
          ],
          introduction: [
            { required: true, message: '介绍', trigger: 'blur' }
          ]
        },
		shop_id: '',
		restaurant_logo: '',
		restaurant_background: '',
		//business_hour: [],
		images: '',
		shopStatuses: [],
        dialogRestaurantLogoUrl: '',
        dialogRestaurantLogoVisible: false,
        dialogAppLogoUrl: '',
        dialogAppLogoVisible: false,
        dialogRestaurantImagesUrl: '',
        dialogRestaurantImagesVisible: false,
        business_hour: {
          monday_time: "7:00,18:00",
          tuesday_time: "7:00,18:00",
          wednesday_time: "7:00,18:00",
          thursday_time: "7:00,18:00",
          friday_time: "7:00,18:00",
          saturday_time: "7:00,18:00",
          sunday_time: "7:00,18:00"
        }
      };
    },

	created() {
		this.fetchShopStatuses()
	},

    methods: {

      changeMonday (value) {
          this.business_hour.monday_time =  parseTime(value[0], "{h}:{i}") + "," + 
				parseTime(value[1], "{h}:{i}")
      },
      changeTuesday (value) {
        this.business_hour.tuesday_time =  parseTime(value[0], "{h}:{i}") + "," + 
				parseTime(value[1], "{h}:{i}")
      },
      changeWednesday (value) {
        this.business_hour.wednesday_time =  parseTime(value[0], "{h}:{i}") + "," + 
				parseTime(value[1], "{h}:{i}")
      },
      changeThursday (value) {
        this.business_hour.thursday_time =  parseTime(value[0], "{h}:{i}") + "," + 
				parseTime(value[1], "{h}:{i}")
      },
      changeFriday (value) {
        this.business_hour.friday_time =  parseTime(value[0], "{h}:{i}") + "," + 
				parseTime(value[1], "{h}:{i}")
      },
      changeSaturday (value) {
        this.business_hour.saturday_time =  parseTime(value[0], "{h}:{i}") + "," + 
				parseTime(value[1], "{h}:{i}")
      },
      changeSunday (value) {
        this.business_hour.sunday_time =  parseTime(value[0], "{h}:{i}") + "," + 
				parseTime(value[1], "{h}:{i}")
      },

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
        console.log(window.sessionStorage.getItem('shop_id'))
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
                    window.sessionStorage.setItem("shop_id", response.data.data)
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

      updateBusinessHour() {
		http({
            url: ApiList.updateShopUrl + window.sessionStorage.getItem("shop_id"),
			method: 'put',
            data: {"business_hour": this.business_hour}
		}).then(response => {
			if (response.data.code == 200) {
				this.next()
			}
		}, response => {
			console.log("fetch data error")
		})
      },

      uploadRestaurantLogoImg (param) {

        let formData = new FormData()
        formData.append('file', param.file)
        formData.append('id', window.sessionStorage.getItem("shop_id"))
        formData.append('type', 'restaurant_logo')

		http({
			url: ApiList.uploadShopImgUrl,
			method: 'post',
            data: formData
		}).then(response => {
			if (response.data.code == 200) {
				this.$message({
					type: 'success',
					message: this.$i18n.t("common.updateSuccess")
				});
			}
		}, response => {
			console.log("fetch data error")
		})

      },

      uploadAppLogoImg (param) {

        let formData = new FormData()
        formData.append('id', window.sessionStorage.getItem("shop_id"))
        formData.append('file', param.file)
        formData.append('type', 'restaurant_background')

		http({
			url: ApiList.uploadShopImgUrl,
			method: 'post',
            data: formData
		}).then(response => {
			if (response.data.code == 200) {
				this.$message({
					type: 'success',
					message: this.$i18n.t("common.updateSuccess")
				});
			}
		}, response => {
			console.log("fetch data error")
		})

      },

      uploadRestaurantImages (param) {

        let formData = new FormData()
        formData.append('id', window.sessionStorage.getItem("shop_id"))
        formData.append('file', param.file)
        formData.append('type', 'images')

		http({
			url: ApiList.uploadShopImgUrl,
			method: 'post',
            data: formData
		}).then(response => {
			if (response.data.code == 200) {
				this.$message({
					type: 'success',
					message: this.$i18n.t("common.updateSuccess")
				});
			}
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
  .dayRow {
      margin: 20px auto;
  }
  .shopOpeningTime {
    margin-top: 30px;
  }
</style>
