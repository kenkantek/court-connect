@extends('admin.layouts.master')
@section('title_heading')
	Manager Bookings
@stop
@section('content')
	<div class="box box-primary">
		<div class="box-header with-border content-header">
			<h3 class="box-title"><i class="fa fa-users"></i>Manager Bookings</h3>
			<ol class="breadcrumb">
				<li><a href="{!! route('admin.index') !!}"><i class="fa fa-home"></i> Home</a></li>
				<li class="active">Manager Bookings</li>
			</ol>
		</div>

		<div class="box-body">
			<manage-booking
				:club-setting-id.sync="clubSettingId"
			></manage-booking>
		</div>
	</div>


	<style>
		#myModal{
			z-index: 3000;
		}
		.modal-content{
			color: #000;
			text-align: left;
		}
		#myModalLabel{
			text-align: center;
			font-size: 2em;;
		}
		.modal.in .modal-dialog{
			background: #fff;;
		}
		#day-view-content table {
			table-layout: fixed;
			width: 100%;
			*margin-left: -100px;/*ie7*/
		}
		#day-view-content td, #day-view-content th {
			vertical-align: top;
			border-top: 1px solid #ccc;
			padding:10px;
			width:100px;
		}
		#day-view-content tbody tr{
			min-height: 40px;
			height: 40px;
		}
		#day-view-content tbody tr th {
			position: absolute;
			width: 100px;
		}
		#day-view-content {
			overflow-x:scroll;
			overflow-y:visible;
		}
		#mb-create-new-booking .mb-tab-content{
			padding-top: 20px;
			overflow: hidden;
		}
		.btn-md-cpl{
			clear: both;
			margin: 10px auto;
			display: block;
			width: 240px;
		}
		.btn-md-cpl i{
			padding-right: 20px;
		}
	</style>
	<script type="text/javascript">
		$(function() {

			$("#myModal .modal-dialog").css('height',$(window).height() - 50);
			//calendar
			function getDaysInMonth(month, year) {
				// Since no month has fewer than 28 days
				var date = new Date(year, month, 1)
				var days = [];
				while (date.getMonth() === month) {
					days.push(new Date(date));
					date.setDate(date.getDate() + 1);
				}
				return days;
			}

			var w_grid = ($('#calendar_bookings .days-in-month-wrap').width())/7;
			$('#calendar_bookings .days .day-item').css('width',w_grid);

			$("body").on('click','#next-day-in-month',function(){
				var w_left = parseFloat($('#calendar_bookings .days-in-month-wrap .days').css('margin-left'));
				w_grid = ($('#calendar_bookings .days-in-month-wrap').width())/7;
				w_left -= w_grid;
				if(Math.abs(w_left) < parseInt($('#calendar_bookings .days-in-month-wrap .days').css('width')) - w_grid *6 )
					return;
				$('#calendar_bookings .days-in-month-wrap .days').css('margin-left',w_left);
			});

			$("body").on('click','#prev-day-in-month',function(){
				var w_left = parseFloat($('#calendar_bookings .days-in-month-wrap .days').css('margin-left'));
				w_grid = ($('#calendar_bookings .days-in-month-wrap').width())/7;
				w_left += w_grid;
				if(w_left > 1 )
					return;
				$('#calendar_bookings .days-in-month-wrap .days').css('margin-left',w_left);
			});

			//drag
			//$( "#day-view-content > table" ).draggable();
			// end calendar

			//$(".create_new_book").click();


			$('.datetimepicker').datetimepicker({defaultDate: new Date(), format: 'MM/DD/YYYY'});

			$('.daterange').daterangepicker();
			$("body").on('click',".day-view-content .day-grid.available",function(event){
				if($(this).hasClass('gn')){
					event.preventDefault();
					return false;
				}
				$("#md-booking-content-expand").hide();
				$("#md-available-content-expand").css({'display':'block','width': $(".day-view-content").width() - 100});
				var tooltipX =  110;
				var tooltipY = event.pageY + 8 - $("#day-view-content").offset().top + 40;
				$("#md-available-content-expand").css({top: tooltipY, left: tooltipX});
			});

			$("body").on('click',".day-view-content .day-grid.open, .day-view-content .day-grid.contract, .day-view-content .day-grid.lesson",function(event){
				$("#md-available-content-expand").hide();
				$("#md-booking-content-expand").css({'display':'block','width': $(".day-view-content").width() - 100});
				var tooltipX =  110;
				var tooltipY = event.pageY + 8 - $("#day-view-content").offset().top + 40;
				$("#md-booking-content-expand").css({top: tooltipY, left: tooltipX});
			});

			$("body").on('click','#md-available-content-expand .close',function(){
				$("#md-available-content-expand").hide();
			})
			$("body").on('click','#md-booking-content-expand .close, #mb-cancel-booking',function(){
				$("#md-booking-content-expand").hide();
			})

			$(document).on("click",'.btn-in-expand',function(){
				//console.log($(this).parent().find('.show-expand').html());
				$('.show-expand').slideToggle();
			});

			$('#mb-book-day-open').datetimepicker({
				inline: true,
				sideBySide: false,
				format: 'MM/DD/YYYY',
			});
			$('#card-expiry').datetimepicker({
				format: 'MM/YY',
			})
			$('#mb-book-day-contract').daterangepicker()

			$(".irs-slider.single").css('background',"abc");

			$("input[name='book-type']").on('change',function(){
				$(".slc-type-group").addClass('hidden');
				$(".slc-type-" + $(this).val()).removeClass('hidden');
			});

			$("#book-type-open").click();


			$(".js-data-user-ajax").select2({
				ajax: {
					url: "{{route('booking.players')}}",
					dataType: 'json',
					delay: 250,
					data: function (params) {
						return {
							q: params.term, // search term
							page: params.page
						};
					},
					processResults: function (data, params) {
						// parse the results into the format expected by Select2
						// since we are using custom formatting functions we do not need to
						// alter the remote JSON data, except to indicate that infinite
						// scrolling can be used
						params.page = params.page || 1;

						return {
							results: data,
							pagination: {
								more: (params.page * 30) < data.total_count
							}
						};
					},
					cache: true
				},
				escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
				minimumInputLength: 1,
				templateResult: formatRepo, // omitted for brevity, see the source of this page
				templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
			});

			function formatRepo (repo) {
				if (repo.loading) return repo.text;

				var markup = "<div class='select2-result-repository clearfix'>" +
						"<div class='select2-result-repository__title'><strong>Email: </strong>" + repo.email + "</div>";

				if (repo.address1) {
					markup += "<div class='select2-result-repository__description'><strong>Address: </strong> " + repo.address1 + "</div>";
				}

				return markup;
			}

			function formatRepoSelection (repo) {
				return repo.email || repo.address1;
			}


			$(document).on("click",'.col-court-name',function(){
				var court_id = $(this).data('court_id');
				$(".day-grid[data-court='"+court_id+"']").addClass('selected');
			});
		});
	</script>
@stop
