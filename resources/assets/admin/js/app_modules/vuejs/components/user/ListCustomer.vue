<template>
    <table id="tbl-listteacher" class="table table-bordered table-hover table-th">
        <thead>
        <tr>
            <th></th>
            <th>Full Name</th>
            <th>Email</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(index,teacher) in data.data"  >
            <td><input type="checkbox" class="court-item-check" name="court-item-check" value="{{index}}" @click="addTeacher(index)"></td>
            <td>{{ teacher.fullname }}</td>
            <td>{{ teacher.email }} </td>
        </tr>
        </tbody>
    </table>
    <filter
            :data.sync="data"
    ></filter>
</template>
<style scoped>
    tr td{
        text-align: left;
    }
</style>
<script>
    import Filter from '../globals/Filter.vue';
    var _ = require('lodash'),
            deferred = require('deferred');
    var tmp_choice = null;
    export default {
        props:['clubSettingId','teachers_choice','teachers','reloadTeachers'],
        data(){
            return {
                data: {
                    per_page: "10",
                },
                api:laroute.route('customer.listdata'),
            }
        },
        watch: {
            clubSettingId: 'reloadAsyncData',
            reloadTeachers: 'reloadAsyncData',
        },
        asyncData(resolve, reject) {
            this.fetchTeachers(this.api).done((data) => {
                resolve({data});
        }, (error) => {
                console.log(error);
            });

        },
        methods: {
            fetchTeachers(api, clubid = this.clubSettingId, take = this.data.per_page) {
                let def = deferred();
                this.$http.get(api ,{ clubid, take}).then(res => {
                    const { data } = res;
                def.resolve(data);
            }, res => {
                    def.reject(res);
                });
                return def.promise;
            },
        },
        events: {
            'go-to-page'(api) {
                console.log(api);
                this.api = api;
                this.reloadAsyncData();
            }
        },

        components: { Filter }
    }
</script>