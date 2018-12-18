<template>
    <div>
      <div class="toolbar">
          <el-button type="primary" icon="el-icon-refresh" circle v-on:click="fetchTableData"></el-button>
          <el-button type="success" icon="el-icon-plus" circle v-on:click="uploadPicture"></el-button>
      </div>

      <el-table
        :data="tableData"
        border
        style="width: 100%">

        <el-table-column
          type="index"
          width="50">
        </el-table-column>

        <el-table-column
          label="url"
          prop="url">
            <template slot-scope="scope">
                <img :src="scope.row.url" alt="picture" style="width: 50px;height: 50px">
            </template>
        </el-table-column>

        <el-table-column
          label="desc"
          prop="desc">
        </el-table-column>

        <el-table-column
          label="tag_name"
          prop="tag_name">
        </el-table-column>

        <el-table-column
          label="order"
          prop="order">
        </el-table-column>

        <el-table-column
          align="center"
          width="200">
          <template slot="header" slot-scope="scope">
            <el-input
              v-model="search"
              size="mini"
              placeholder="输入关键字搜索"/>
          </template>
          <template slot-scope="scope">
            <el-button
              size="mini"
              type="success"
              icon="el-icon-edit"
              round
              @click="handleEdit(scope.$index, scope.row)">Edit</el-button>
            <el-button
              size="mini"
              type="danger"
              icon="el-icon-delete" 
              round
              @click="handleDelete(scope.$index, scope.row)">Delete</el-button>
          </template>
        </el-table-column>
      </el-table>
    </div>
</template>

<script>
  import { http } from './../../utils/fetch'
  import ApiList from './../../config'

  export default {
    data() {
      return {
        tableData: [],
        tableStatusFilter: [],
        search: ''
      }
    },

	created() {
	  this.fetchTableData()
	},

    methods: {

      uploadPicture() {
        this.$router.push('/picture/create')
      },

      //过滤标签
      filterTag(value, row) {
        return row.shop_status_name === value;
      },

      //获取table数据
	  fetchTableData() {
		http({
			url: ApiList.getUserPictureUrl,
			method: 'get',
		}).then(response => {
            console.log(response.data)
			this.tableData = response.data.data
		}, response => {
			console.log("fetch data error")
		})
	  },

      //编辑操作
      handleEdit(index, row) {
        this.$router.push('/picture/show/' + row.id)
      },

      //删除操作
      handleDelete(index, row) {
		
        this.$confirm(this.$i18n.t("common.deleteConfirm"), this.$i18n.t("common.prompt"), {
          confirmButtonText: this.$i18n.t("common.sure"),
          cancelButtonText: this.$i18n.t("common.cancel"),
          type: 'warning'
        }).then(() => {

			//删除店铺
			http({
				url: ApiList.deletePictureUrl + row.id,
				method: 'delete',
			}).then(response => {
				if (response.data.code == '200') {
					this.$message({
						type: 'success',
						message: this.$i18n.t("common.deleteSuccess")
					});
                    this.fetchTableData()
				}
			}, response => {
				console.log("fetch data error")
			})

        }).catch(() => {

          this.$message({
            type: 'info',
            message: this.$i18n.t("common.deleteCancel")
          });          

        });
	  },
	}
  }
</script>
<style scoped>
.toolbar {
    margin: 10px 5px 10px 0;
}
</style>
