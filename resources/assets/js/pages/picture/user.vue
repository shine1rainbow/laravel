<template>
	<div>
		<div class="upload-control">
			<el-upload
				action="test"
				:http-request="uploadImg"
				list-type="picture-card"
				:limit="1"
				:on-preview="handlePicturePreview"
				:on-remove="handlePictureRemove">
				<i class="el-icon-plus" style="margin-top: 52px"></i>
			</el-upload>
		</div>
		<div>
			<el-form :label-position="labelPosition" label-width="80px" :model="left">
			  <el-form-item label="图片URL">
				<el-input v-model="pictureForm.url"></el-input>
			  </el-form-item>
			  <el-form-item label="图片标签">
				<el-select v-model="pictureForm.tag_id" placeholder="请选择">
				  <el-option v-for="tag in tags" :key="tag.id" :label="tag.name" :value="tag.id"></el-option>
				 </el-select>
			  </el-form-item>
			  <el-form-item label="图片描述">
				<el-input v-model="pictureForm.desc"></el-input>
			  </el-form-item>
			</el-form>
		</div>

		<el-row>
		  <el-col :span="8" v-for="(o, index) in 2" :key="o" :offset="index > 0 ? 2 : 0">
			<el-card :body-style="{ padding: '0px' }">
			  <img src="http://element-cn.eleme.io/static/hamburger.50e4091.png" class="image">
			  <div style="padding: 14px;">
				<span>好吃的汉堡</span>
				<div class="bottom clearfix">
				  <time class="time">{{ currentDate }}</time>
				  <el-button type="text" class="button">操作按钮</el-button>
				</div>
			  </div>
			</el-card>
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
	  dialogPictureUrl: '',
	  dialogPictureVisible: false,
      currentDate: new Date(),
      pictureForm: {
          order: '',
          desc: '',
          tag_id: '',
          url: ''
	  },
	  tags: [],
    };
  },

  created() {
	this.fetchUserTagList()
  },

  methods: {
      handlePictureRemove(file, fileList) {
        console.log(file, fileList);
      },
      handlePicturePreview(file) {
        this.dialogPictureUrl = file.url;
		console.log(this.dialogPictureUrl);
        this.dialogPictureVisible = true;
      },

  	  //获取用户标签列表
	  fetchUserTagList() {
		http({
			url: ApiList.getTagListByUserUrl,
			method: 'get',
		}).then(response => {
			this.tags = response.data.data.tableData
		}, response => {
			console.log("fetch data error")
		})
	  },

      uploadImg (param) {

        let formData = new FormData()
        formData.append('file', param.file)

		http({
			url: ApiList.uploadPictureUrl,
			method: 'post',
            data: formData
		}).then(response => {
            console.log(response.data)
		}, response => {
			console.log("fetch data error")
		})
	  }
  }
}
</script>

<style>
  .time {
    font-size: 13px;
    color: #999;
  }
  
  .bottom {
    margin-top: 13px;
    line-height: 12px;
  }

  .button {
    padding: 0;
    float: right;
  }

  .image {
    width: 100%;
    display: block;
  }

  .clearfix:before,
  .clearfix:after {
      display: table;
      content: "";
  }
  
  .clearfix:after {
      clear: both
  }
  .el-upload__input {
	display: none !important
  }
</style>
