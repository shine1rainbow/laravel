<template>
  <el-table
    :data="tableData.filter(data => !search || data.restaurant_name.toLowerCase().includes(search.toLowerCase()))"
    border
    style="width: 100%">

    <el-table-column
      type="index"
      width="50">
    </el-table-column>

    <el-table-column
      label="restaurant_name"
      prop="restaurant_name">
    </el-table-column>

    <el-table-column
      label="nickname"
      prop="nickname">
    </el-table-column>

    <el-table-column
      label="first_name"
      prop="first_name">
    </el-table-column>

    <el-table-column
      prop="last_name"
      label="last_name"
      width="180">
    </el-table-column>

    <el-table-column
      label="position"
      prop="position">
    </el-table-column>

    <el-table-column
      label="age"
      prop="age">
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

      //过滤标签
      filterTag(value, row) {
        return row.shop_status_name === value;
      },

      //获取table数据
	  fetchTableData() {
		http({
			url: ApiList.getStaffUrl,
			method: 'get',
		}).then(response => {
            let shops = response.data.data
			this.tableData = shops
		}, response => {
			console.log("fetch data error")
		})
	  },

      //编辑操作
      handleEdit(index, row) {
        this.$router.push('/menu/show/' + row.id)
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
				url: ApiList.deleteMenuUrl + row.id,
				method: 'delete',
			}).then(response => {
				if (response.data.code == '200') {
					this.$message({
						type: 'success',
						message: this.$i18n.t("common.deleteSuccess")
					});
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
