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
				 :reload-contracts.sync = "reloadContracts"
				 :contract-select.sync = "contractSelect"
				>
					
				</list>
			<contract-rate
				v-show="showContract"
				v-if="ifContract"
			>
			</contract-rate>	
			<contract-rate-edit
				:contract-select.sync = "contractSelect"
				:reload-contracts.sync = "reloadContracts"
				:if-contract-edit.sync = "ifContractEdit"
				:show-contract.sync = "showContract"
				v-if="ifContractEdit"
				v-show="showContractEdit"
			>
			</contract-rate-edit>
		</section>

		<section class="col-xs-12 col-md-5">
			<form-edit 
			v-if="!addnew"
			:club-setting-id="clubSettingId"
			></form-edit>
			<form-new  v-else
			:club-setting-id="clubSettingId"
			:reload-contracts.sync = "reloadContracts"
			></form-new>
		</section>
</template>
<script>
	import List from './List.vue';
	import FormNew from './FormNew.vue';
	import FormEdit from './FormEdit.vue';
	import ContractRate from './ContractRate.vue';
	import ContractRateEdit from './ContractRateEdit.vue';
	export default {
		props: ['clubSettingId'],
		data() {
			return {
				addnew:true,
				contracts:[],
				reloadContracts:1,
				contractSelect:null,
				contractEdit:false,

				ifContract:true,
				showContract:true,
				ifContractEdit:false,
				showContractEdit:false,
			}
		},
		watch: {
	    contractSelect:function (){
	    	if( this.contractSelect == null){
	    			this.ifContractEdit = false;
						this.showContractEdit = false;
						this.ifContract = true;
						this.showContract = true;
	    	}else{
	    			this.ifContract = false;
						this.showContract = false;
						this.ifContractEdit = true;
						this.showContractEdit = true;
	    	}
	    }    	    
	  },
		components: {
			List,
			FormNew,
			FormEdit,
			ContractRate,
			ContractRateEdit
		}
	}
</script>