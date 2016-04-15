import Vue from 'vue';

Vue.use(require('vue-resource'));
Vue.use(require('vue-async-data'));
Vue.http.headers.common['X-CSRF-TOKEN'] = _token;
import ClubSetting from './vuejs/components/club/ClubSetting.vue';
import SuperSetting from './vuejs/components/super/SuperSetting.vue';
import HeaderMain from './vuejs/components/header/HeaderMain.vue';
import UserSetting from './vuejs/components/user/UserSetting.vue';

 var _ = require('lodash'),
     deferred = require('deferred');
new Vue({
	el: 'body',
	data() {
		return {
			clubSettingId:null,
			clubs:[],
			delete_club:1,
			user:userLogin,
		}
	},
    components: {
		ClubSetting,
        SuperSetting,
        HeaderMain,
		UserSetting,
    },
});


















































































