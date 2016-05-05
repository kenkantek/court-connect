<template>
    <div class="clearfix"></div>
    <div class="row" v-if="data">
        <div class="col-md-12 col-sm-12">
            <div class="pagination-panel">
                <div class="col-md-offset-6 col-md-6 text-right">  
                    <label>Page</label>  
                    <a href="#" class="btn btn-sm default prev" @click.prevent="prevPage" :disabled="!data.prev_page_url">
                        <i class="fa fa-angle-left"></i>
                    </a>
                        <input type="text" class="pagination-panel-input form-control input-sm input-inline input-mini" v-model="data.current_page" @keyup.enter="onGoPage">
                    <a href="#" class="btn btn-sm default next"  @click.prevent="prevNext" :disabled="!data.next_page_url">
                        <i class="fa fa-angle-right"></i>
                    </a>
                     of <span class="pagination-panel-total">{{ data.last_page }}</span>
                </div>
                <div class="col-md-6 hidden">
                     <label><span class="seperator">|</span>View
                         <select class="form-control input-xs input-sm input-inline" v-model="data.per_page">
                             <option value="10">10</option>
                             <option value="20">20</option>
                             <option value="50">50</option>
                             <option value="100">100</option>
                             <option value="150">150</option>
                         </select> records
                     </label>
                     <span class="seperator">|</span>Found total {{ data.total }} records
                </div> 
            </div>
        </div>
    </div>
</template>
<style scoped>
    .pagination-panel-input {
        width: 50px;
        display: inline-block;
    }
    select {
        display: inline-block;
        width: 70px;
    }
</style>
<script>

    export default {
        props: ['data'],
        methods: {

            prevPage() {
                this.data.prev_page_url && 
                this.$dispatch('go-to-page', this.data.prev_page_url);
            },

            prevNext() {
                this.data.next_page_url && 
                this.$dispatch('go-to-page', this.data.next_page_url);
            },

            onGoPage() {
                const page = this.data.current_page;
                let url = this.data.next_page_url || this.data.prev_page_url || null;
                if((page > 0 && page <= this.data.last_page) && url) {
                    return this.$dispatch('go-to-page', url.replace(/page=[\d]+/, `page=${page}`));
                }

                toastr.warning('Can not go to page number ' + page);
            }
        } 
    }
</script>