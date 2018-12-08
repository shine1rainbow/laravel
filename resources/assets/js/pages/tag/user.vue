<template>

	<div class="box box-info">
  
		<div class="box-header with-border">
			<el-button
				type="primary"
				icon="el-icon-edit"
				@click="dialogAddFormVisible = true"
			>添加标签</el-button>
		</div>

		<data-tables 
			:action-col="actionCol"
			:data="tableData" 
			:pagination-props="{ pageSizes: [5, 10, 15] }"
			:loading="loading"
		>
			<el-table-column 
				v-for="title in tableTitles"
				:prop="title.prop"
				:label="title.label"
				:key="title.label"
            	sortable="custom"
			>
			</el-table-column>
		</data-tables>

		<el-dialog title="编辑标签" :visible.sync="dialogFormVisible">
		  <el-form :model="form">
			<el-form-item label="标签名称" :label-width="formLabelWidth">
			  <el-input v-model="form.name" autocomplete="off"></el-input>
			</el-form-item>
			<el-form-item label="标签描述" :label-width="formLabelWidth">
			  <el-input v-model="form.desc" autocomplete="off"></el-input>
			</el-form-item>
		  </el-form>
		  <div slot="footer" class="dialog-footer">
			<el-button @click="dialogFormVisible = false">取 消</el-button>
			<el-button type="primary" @click="updateRow">更 新</el-button>
		  </div>
		</el-dialog>

		<el-dialog title="添加标签" :visible.sync="dialogAddFormVisible">
		  <el-form :model="addForm" :rules="addRules">
			<el-form-item label="标签名称" :label-width="formLabelWidth">
			  <el-input v-model="addForm.name" autocomplete="off"></el-input>
			</el-form-item>
			<el-form-item label="标签描述" :label-width="formLabelWidth">
			  <el-input v-model="addForm.desc" autocomplete="off"></el-input>
			</el-form-item>
		  </el-form>
		  <div slot="footer" class="dialog-footer">
			<el-button @click="dialogAddFormVisible = false">取 消</el-button>
			<el-button type="primary" @click="addRow">确 定</el-button>
		  </div>
		</el-dialog>
	</div>
</template>

<script>
  import { http } from './../../utils/fetch'
  import { decryptData } from './../../utils/encrypt'
  import ApiList from './../../config'

  export default {

  data() {
	  return {
		tableData: [],
		tableTitles: [],
		loading: false,
		actionCol: {
			label: this.$i18n.t("common.operate"),
			props: {
				align: 'center',
			},
			buttons: [{
					props: {
						type: 'primary',
						size: 'mini',
						icon: 'el-icon-edit'
					},
					handler: row => {
						this.editRow(row)
					},
					label: this.$i18n.t("common.edit")
				}, {
					handler: row => {
						this.deleteRow(row)
					},
					label: this.$i18n.t("common.delete"),
					props: {
						type: 'danger',
						size: 'mini',
						icon: 'el-icon-delete'
					},
				}]
			},
			formLabelWidth: '120px',
			dialogFormVisible: false,
			form: {
				name: '',
				desc: ''
			},
			dialogAddFormVisible: false,
			addForm: {
				name: '',
				desc: ''
			},
			addRules: {
				name: [
					{ required: true, message: '请输入标签名称', trigger: 'blur' },
				],
				desc: [
					{ required: true, message: '请输入标签描述', trigger: 'blur' }
				]
			}
		}
	},

	created() {
		this.fetchData();
	},

    methods: {

		//获取用户Tag数据
		fetchData() {
			this.loading = true

			http({
				url: ApiList.getTagListByUserUrl,
				method: 'get',
			}).then(response => {
				this.tableData = response.data.data.tableData
				this.tableTitles = response.data.data.tableTitles
			}, response => {
				console.log("fetch data error")
			})

			this.loading = false
		},

		//添加tag
		addRow() {

			const postData = {
				name: this.addForm.name,
				desc: this.addForm.desc,
			}

			http({
				url: ApiList.storeTagUrl,
				method: 'post',
				data: postData
			}).then(response => {
				if (response.data.code == 200) {
					this.dialogAddFormVisible = false
					this.$notify({
						title: response.data.code,
						message: response.data.msg,
						duration: 2000,
						type: "success"
					});

					//重新渲染表格数据
					this.fetchData();

				} else {
					this.$notify({
						title: response.data.code,
						message: response.data.msg,
						duration: 2000,
						type: "danger"
					});
				}
			}, response => {
				console.log("fetch data error")
			})
    	},
		
		//编辑行
		editRow(row) {
			this.dialogFormVisible = true
			this.form.id = row.id
			this.form.name = row.name
			this.form.desc = row.desc
    	},

		//更新行
		updateRow() {
    		
			const postData = {
				name: this.form.name,
				desc: this.form.desc,
			}
			
			http({
				url: ApiList.updateTagUrl + this.form.id,
				method: 'put',
				data: postData
			}).then(response => {
				if (response.data.code == 200) {
					this.dialogFormVisible = false
					this.$notify({
						title: response.data.code,
						message: response.data.msg,
						duration: 2000,
						type: "success"
					});

					//重新渲染表格数据
					this.fetchData();

				} else {
					this.$notify({
						title: response.data.code,
						message: response.data.msg,
						duration: 2000,
						type: "danger"
					});
				}
			}, response => {
				console.log("fetch data error")
			})
    	},

		//删除行
		deleteRow(row) {

			this.$confirm(this.$i18n.t("common.deleteConfirm"), this.$i18n.t("common.prompt"), {
			  confirmButtonText: this.$i18n.t("common.sure"),
			  cancelButtonText: this.$i18n.t("common.cancel"),
			  type: 'warning'
			}).then(() => {

				//删除标签
				http({
					url: ApiList.deleteTagUrl + row.id,
					method: 'delete',
				}).then(response => {
					if (response.data.code == '200') {
						this.$notify({
							type: 'success',
							message: this.$i18n.t("common.deleteSuccess")
						});
					}

					//重新渲染表格数据
					this.fetchData();

				}, response => {
					console.log("fetch data error")
				})

			}).catch(() => {
			  this.$notify({
				type: 'info',
				message: this.$i18n.t("common.deleteCancel")
			  });          
			});
		}
	}
  }
</script>
