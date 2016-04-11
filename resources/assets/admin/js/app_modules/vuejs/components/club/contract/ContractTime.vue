<template>
	<section class="col-xs-12 col-md-7">
			<div class="courtbox contacttime">
				<slot name="headercontract"></slot>
				<div>
					<p>Creating a contract time period will allow a user to book a regular time slot each week.
					When creating a contract time period, each day of the week can be set to a  different price.</p>					
				</div>
				<list 
				 :contracts.sync="contracts"
				 :club-setting-id.sync="clubSettingId"
				>
					
				</list>
			<contract-rate>
			</contract-rate>
		</section>

		<section class="col-xs-12 col-md-5">
			<form-edit 
			v-if="!addnew"
			:club-setting-id="clubSettingId"
			></form-edit>
			<form-new  v-else
			:club-setting-id="clubSettingId"
			></form-new>
		</section>
</template>
<script>
	import List from './List.vue';
	import FormNew from './FormNew.vue';
	import FormEdit from './FormEdit.vue';
	import ContractRate from './ContractRate.vue';
	export default {
		props: ['clubSettingId'],
		data() {
			return {
						addnew:true,
						contracts:[],
						reloadContracts:1,						
			}
		},
		components: {
			List,
			FormNew,
			FormEdit,
			ContractRate
		}
	}
</script>