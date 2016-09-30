<template>

	<section>
		<div class="court_list courtbox col-xs-12 col-md-7" style="border-bottom: 1px solid #ddd; border-right: 1px solid #ddd;">
			<h3 class="title-box pull-left">Clubs</h3>
			<a class="btn btn-primary pull-right btn-new-court" href=""><i class="fa fa-plus-circle"></i> Add New Club</a>
			<list-club
				:clubs_choice.sync = "clubs_choice"
				:clubs.sync = "clubs"
				:delete_club.sync = "delete_club",
				:reload-clubs.sync="reloadClubs"
				></list-club>
		</div>

		<section style="position: relative; padding-bottom: 20px;">
				<form-new-club
				v-if="clubs_choice == null"
				:clubs.sync="clubs",
				:reload-clubs.sync="reloadClubs"
				>
				</form-new-club>

				<form-edit-club
				v-if="clubs_choice != null"
				:clubs.sync="clubs"
				:clubs_choice.sync = "clubs_choice"
				:delete_club.sync = "delete_club",
				:reload-clubs.sync="reloadClubs"
				>
				</form-edit-club>
		</section>
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
				reloadClubs:1,
			}
		},
		components: {
            ListClub,
            FormNewClub,
            FormEditClub,
        }
	}
</script>