<template>
	<!-- Logo -->
	<a href="/sadmin" class="logo">
		<!-- mini logo for sidebar mini 50x50 pixels -->
		<span class="logo-mini"><b><img src="/uploads/images/logo.png" width="40"></b></span>
		<!-- logo for regular state and mobile devices -->
		<span class="logo-lg"><b><img src="/uploads/images/logo.png" width="70"></b></span>
	</a>
	<!-- Header Navbar: style can be found in header.less -->
	<nav class="navbar navbar-static-top" role="navigation">
		<div class="navbar-header-menu">
			<div class="header-block col-sm-4 col-xs-4">
				<div class="info-box-img">
					<img v-bind:src="club_image" class="club-thump-image" alt="Club Image">
				</div>
				<div class="info-box-content text-center">
					<span class="info-box-text">Managing</span>
					<select id="club" name="club" v-model="clubSettingId">
						<option  v-for="(index,club) in clubs" value="{{club.id}}" data-index="{{index}}" v-text="club.name" ></option>
					</select>
				</div>
				<!-- /.info-box-content -->
			</div>
			<div class="col-sm-5 col-xs-5 text-center">
				<h1>
					{{ title }}
				</h1>
			</div>
			<div class="col-sm-3 col-xs-3">
				<ul class="nav navbar-nav pull-right">
					<li class="pull-right">
						<a href="/sadmin/logout" style="font-size: 35px"><i class="fa fa-sign-out"></i></a>
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
		props: ['clubSettingId','clubs','delete_club','title','user', 'clubSettingIndex'],
		data(){
			return {
				'club_image': null,
				'pageReload': true,
			}
		},
		asyncData(resolve, reject) {
			this.fetchclubsOf().done((clubs) => {
				var idx = $("#club option:selected").data('index');
				if(idx == null)
					idx= 0;
				this.clubSettingId = clubs[idx].id;
				this.club_image = clubs[idx].image;
				this.clubSettingIndex = idx;

				if (!localStorage.clubSettingId) {
					localStorage.setItem('clubSettingId', -1);
				}else{
					if(localStorage.clubSettingId !=  this.clubSettingId && this.clubSettingId != 0) {
						if (expires == undefined || expires == 'null') {
							var expires = 3600;
						} // default: 1h
						var date = new Date();
						var schedule = Math.round((date.setSeconds(date.getSeconds() + expires)) / 1000);

						if(this.pageReload) {
							this.clubSettingId = localStorage.clubSettingId;
						}else{
							 localStorage.clubSettingId = this.clubSettingId;
						}
						localStorage.setItem('clubSettingId', this.clubSettingId);
					}

					this.pageReload = false;
				}

			resolve({clubs});
		}, (error) => {
				console.log(error);
			});

		},
		watch: {
			delete_club: 'reloadAsyncData',
			clubSettingId: 'reloadAsyncData'
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