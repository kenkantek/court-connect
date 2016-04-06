<template>

	<section>
		<div class="court_list courtbox col-xs-12 col-md-7">
			<h3 class="title-box pull-left">Clubs</h3>
			<a class="btn btn-primary pull-right btn-new-court" href=""><i class="fa fa-plus-circle"></i> Add New Club</a>
			<list-club
				:clubs_choice.sync = "clubs_choice"
				:clubs.sync = "clubs"
				:delete_club.sync = "delete_club"
				></list-club>
		</div>
		<div class="form-clubs col-xs-12 col-md-5">
				<form-new-club
				v-if="clubs_choice == null"
				:clubs.sync="clubs"
				>
				</form-new-club>
				<form-edit-club
				v-if="clubs_choice != null"
				:clubs.sync="clubs"
				:clubs_choice.sync = "clubs_choice"
				:delete_club.sync = "delete_club"
				>
				</form-edit-club>
		</div>
	</section>
</template>
<script>
	import ListClub from './ListClub.vue';
	import FormNewClub from './FormNewClub.vue';
	import FormEditClub from './FormEditClub.vue';
	let _ = require('lodash'),
    deferred = require('deferred');
	export default {
		props: ['clubs','clubSettingId','delete_club'],
		data(){
			return {
				clubs_choice:null,
			}
		},
		components: {
            ListClub,
            FormNewClub,
            FormEditClub,
        }
	}
</script>