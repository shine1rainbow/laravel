<template>
	<div class="box box-info">
		<data-tables 
			:action-col="actionCol"
			:data="tableData" 
			:pagination-props="{ pageSizes: [5, 10, 15] }"
			:loading="loading"
		>
			<el-table-column v-for="title in tableTitles" :prop="title.prop" :label="title.label" :key="title.label">
			</el-table-column>
		</data-tables>
	</div>
</template>

<script>
  import { http } from './../../utils/fetch'
  import ApiList from './../../config'

  export default {

  data() {
	  return {
		tableData: [],
		tableTitles: [],
		loading: false,
		actionCol: {
			label: 'Actionsssssss',
			props: {
				align: 'center',
			},
			buttons: [{
					props: {
						type: 'primary',
						icon: 'el-icon-edit'
					},
					handler: row => {
						this.editRow(row)
					},
					label: 'Edit'
				}, {
					handler: row => {
						this.tableData.splice(this.tableData.indexOf(row), 1)
					},
					label: 'delete'
				}]
			}
		}
	},

	created() {
		this.fetchData();
	},

    methods: {
		fetchData() {
			this.loading = true

			http({
				url: ApiList.getTagListByUserURL,
				method: 'get',
			}).then(response => {
				this.tableData = response.data.data.tableData
				this.tableTitles = response.data.data.tableTitles
			}, response => {
				console.log("fetch data error")
			})

			this.loading = false
		},
		
		editRow(row) {
			//this.$message('Edit clicked')
			//	row.flow_no = 'hello word' + Math.random()
			//	row.content = Math.random() > 0.5 ? 'Water flood' : 'Lock broken'
			//	row.flow_type = Math.random() > 0.5 ? 'Repair' : 'Help'
    	}
	}
  }
</script>
