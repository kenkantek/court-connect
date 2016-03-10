import Vue from 'vue';

Vue.use(require('vue-resource'));
Vue.use(require('vue-async-data'));
Vue.http.headers.common['X-CSRF-TOKEN'] = _token;
123123123123
import ClubSetting from './vuejs/components/club/ClubSetting.vue';
new Vue({
	el: 'body',
    components: {
        ClubSetting,
    },
});