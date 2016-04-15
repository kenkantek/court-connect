<template>
    <form action="" method="post" id="form_search_booking">
        <div class="pull-left col-xs-12 col-md-3">
            <h2 class="title-search">Find a Booking</h2>
        </div>
        <div class="pull-left col-xs-12 col-md-3">
            <div class="col-xs-12 col-md-10">
                <label for="reference_number">Reference Number</label>
                <input class="form-control" name="reference_number" type="text" id="reference_number">
            </div>
            <div class="col-xs-12 col-md-2"><br><br> Or</div>
        </div>
        <div class="pull-left col-xs-12 col-md-3">
            <label for="customer_name">Name</label>
            <input class="form-control" name="customer_name" type="text" id="customer_name">
        </div>
        <div class="pull-left col-xs-12 col-md-3">
            <label for=" " style="color: #fff">.</label>
            <input class="btn btn-primary" style="display: block" type="submit" value="Search">
        </div>
        <div class="clearfix"></div>
        <div id="result_search">
            <h3 class="text-center">Search Results</h3>
            <table>
                <tr>
                    <th>Booking Reference</th>
                    <th>Customer Name</th>
                    <th>Customer Phone</th>
                    <th>Booking Details</th>
                </tr>
                <tr>
                    <td>12345678</td>
                    <td>Peter Vardy</td>
                    <td>0123456789</td>
                    <td>
                        Court #1 - Friday 29th January 2016 @16:00
                        <a href="#" class="viewbooking btn btn-primary">View</a>
                        <a href="#" class="editbooking btn btn-primary">Edit</a>
                        <a href="#" class="checkIn btn btn-primary">Check In</a>
                    </td>
                </tr>
            </table>
        </div>
    </form>
</template>
<script>
    var _ = require('lodash'),
        deferred = require('deferred');
    export default {
        props: ['clubSettingId','dateChooise']
    }
</script>