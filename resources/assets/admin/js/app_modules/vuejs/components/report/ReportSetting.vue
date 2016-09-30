<template>

	<section>
		<div class="court_list courtbox col-xs-12 col-md-12">
			<h3 class="title-box pull-left">Reports</h3>
			<list-booking
					:club-setting-id="clubSettingId",
					:club-setting-index="clubSettingIndex",
					:clubs="clubs"
				></list-booking>
		</div>
	</section>
</template>
<script>
	import ListBooking from './ListBooking.vue';
	let _ = require('lodash'),
    deferred = require('deferred');
	export default {
		props: ['clubSettingId', 'clubSettingIndex', 'clubs'],
		data(){
			return {

			}
		},
		components: {
			ListBooking
        }
	}
</script>