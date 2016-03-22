<template>
<!-- Logo -->
<a href="http://courtconnect.local/sadmin" class="logo">
	<!-- mini logo for sidebar mini 50x50 pixels -->
	<span class="logo-mini"><b><img src="/uploads/images/logo.png" width="40"></b></span>
	<!-- logo for regular state and mobile devices -->
	<span class="logo-lg"><b><img src="/uploads/images/logo.png" width="70"></b></span>
</a>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top" role="navigation">
	<div class="navbar-header-menu">
		<div class="header-block col-md-4">
			<div class="info-box-img">
				<img src="http://courtconnect.local/uploads/images/tiger-raquest.jpeg" class="club-thump-image" alt="Club Image">
			</div>
			<div class="info-box-content text-center">
				<span class="info-box-text">Managing</span>
				<select id="club" name="club" v-model="clubSettingId">
				<option  v-for="(index,club) in clubs" value="{{club.id}}" v-text="club.name" ></option>
				</select>
			</div>
			<!-- /.info-box-content -->
		</div>
		<div class="col-md-5 text-center">
			<h1>
			{{ title }}
			</h1>
		</div>
		<div class="col-md-3">
			<ul class="nav navbar-nav pull-right">
				<li class="pull-right">
					<a href="http://courtconnect.local/sadmin/logout" style="font-size: 35px"><i class="fa fa-sign-out"></i></a>
				</li>
				<li class="user user-menu pull-right">
					<a href="#">
						<label class="hidden-xs">Login</label>
						<!-- <img :src="user.avatar" class="user-image" alt="User Image"> -->
						<span class="hidden-xs">{{ user.fullname }}</span>
					</a>
				</li>
			</ul>
		</div>
	</div>
</nav>
</template>
<script>
		 var _ = require('lodash'),
     deferred = require('deferred');
		export default {
		props: ['clubSettingId','clubs','delete_club','title','user'],
		asyncData(resolve, reject) {
         this.fetchclubsOf().done((clubs) => {
         		this.clubSettingId = clubs[0].id;
             resolve({clubs});
         }, (error) => {
             console.log(error);
         });

    },
    watch: {
	    delete_club: 'reloadAsyncData',	    
	  },
		methods: {
			fetchclubsOf() {
          let def = deferred(),
          url = laroute.route('dashboard.clubs.list');
          this.$http.get(url).then(res => {
          	def.resolve(res.data);
          }, res => {
          	def.reject(res);
          });
           return def.promise;
      },
		}
	}
</script>