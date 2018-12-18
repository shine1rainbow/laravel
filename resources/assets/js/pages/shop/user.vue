<template>
    <div>
      <div class="toolbar">
          <el-button type="primary" icon="el-icon-refresh" circle v-on:click="fetchTableData"></el-button>
          <el-button type="success" icon="el-icon-plus" circle v-on:click="addShop"></el-button>
      </div>

      <el-table
        :data="tableData.filter(data => !search || data.restaurant_name.toLowerCase().includes(search.toLowerCase()))"
        border
        style="width: 100%">

        <el-table-column
          type="index"
          width="50">
        </el-table-column>

        <el-table-column
          label="Name"
          prop="restaurant_name">
        </el-table-column>

        <el-table-column
          label="payment_sequence"
          prop="payment_sequence">
        </el-table-column>

        <el-table-column
          prop="shop_status_name"
          label="status"
          width="180"
          :filters=tableStatusFilter
          :filter-method="filterTag"
          filter-placement="bottom-end">
          <template slot-scope="scope">
            <el-tag
              :type="scope.row.shop_status_name === 'closed' ? 'danger' : 'success'"
              disable-transitions>{{scope.row.shop_status_name}}</el-tag>
          </template>
        </el-table-column>

        <el-table-column
          label="landline"
          prop="landline">
        </el-table-column>

        <el-table-column
          label="address"
          prop="address">
        </el-table-column>

        <el-table-column
          label="created_at"
          prop="created_at">
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
 import { uniqueArray } from './../../utils/util'
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

      //添加类别
      addShop() {
        this.$router.push('/shop/create')
      },

      //过滤标签
      filterTag(value, row) {
        return row.shop_status_name === value;
      },

      //获取table数据
	  fetchTableData() {
		http({
			url: ApiList.getUserShopUrl,
			method: 'get',
		}).then(response => {
            let shops = response.data.data
			this.tableData = shops
			let temp = []
            for (let i = 0; i < shops.length; i++) {
                temp.push({ text: shops[i].shop_status_name, value: shops[i].shop_status_name })
            }

			this.tableStatusFilter = uniqueArray(temp, "text")

		}, response => {
			console.log("fetch data error")
		})
	  },

      //编辑操作
      handleEdit(index, row) {
        this.$router.push('/shop/show/' + row.id)
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
				url: ApiList.deleteShopUrl + row.id,
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
