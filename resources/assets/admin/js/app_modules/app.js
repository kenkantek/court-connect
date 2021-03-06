import Vue from 'vue';

Vue.use(require('vue-resource'));
Vue.use(require('vue-async-data'));
Vue.http.headers.common['X-CSRF-TOKEN'] = _token;
import ClubSetting from './vuejs/components/club/ClubSetting.vue';
import SuperSetting from './vuejs/components/super/SuperSetting.vue';
import HeaderMain from './vuejs/components/header/HeaderMain.vue';
import UserSetting from './vuejs/components/user/UserSetting.vue';
import TeacherSetting from './vuejs/components/user/TeacherSetting.vue';
import ManageBooking from './vuejs/components/booking/ManageBooking.vue';
import NewBooking from './vuejs/components/booking/NewBooking.vue';
import ReportSetting from './vuejs/components/report/ReportSetting.vue';
import CustomerSetting from './vuejs/components/user/CustomerSetting.vue';
 var _ = require('lodash'),
     deferred = require('deferred');
new Vue({
	el: 'body',
	data() {
		return {
			clubSettingId:null,
			clubSettingIndex: null,
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
		TeacherSetting,
		CustomerSetting,
		ManageBooking,
		NewBooking,
		ReportSetting
    },
});