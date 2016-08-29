<table width="650px" border="0" cellspacing="0" cellpadding="0" style="margin:10px auto">
    <tbody>
    <tr style="background: url({{ url("/")."/resources/home/images/header-bg.jpg"}}) ">
        <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding:10px 0 0">
                <tbody>
                    <tr>
                        <td>
                            <img src="{{url("/")}}/uploads/images/logo.png" width="166" height="96" alt="logo court connect" class="CToWUd"></td>
                        <td align="right" valign="top"><span style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#333333;line-height:18px">Court Connect<br></td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td style="padding:10px 0" align="right" valign="middle">
            <a href="#" title="Home" style="line-height:17px;padding:0 5px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#f00;text-decoration:none;font-weight:bold">Home</a>
        </td>
    </tr>
    <tr>
        <td>
            <div style="line-height:18px;color:#333">
                <h1 style="font-size:20px;font-weight:bold;color:#cc0000">Congratulations you have reserved a court!</h1>
                    <span style="display:block;padding:10px 0">Hello
                        <strong>{{$booking['billing_info']['first_name']. " ". $booking['billing_info']['last_name']}}</strong>,
                    </span>
                    <span>
                        You placed an order with the following information:
                    </span>

                <div style="background:#eff0f4;border:1px solid #e2e2e2;padding:10px;margin-top:10px;width:100%;box-sizing: border-box;">
                    <table bgcolor="#FFFFFF" border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tbody>
                        <tr>
                            <td style="text-align:center;border-bottom:1px solid #cdcdcd;border-top:1px solid #cdcdcd;margin:5px 0px">
                                <h2 style="color:#454545;font-size:12px;font-weight:bold; text-transform: uppercase"> information customer</h2>
                            </td>
                            <td style="text-align:center;border-bottom:1px solid #cdcdcd;border-top:1px solid #cdcdcd;margin:5px 0px">
                                <h2 style="color:#454545;font-size:12px;font-weight:bold; text-transform: uppercase"> information Court</h2>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:50%;border-right:1px solid #ccc;border-bottom:1px solid #ccc;padding:8px 5px">
                                <table>
                                    <tbody class="text">
                                    <tr>
                                        <td>Full name: </td>
                                        <td>{{$booking['billing_info']['first_name']. " ". $booking['billing_info']['last_name']}}</td>
                                    </tr>
                                    <tr>
                                        <td>Email: </td>
                                        <td><a href="mailto: {{$booking['billing_info']['email']}}" target="_blank">{{$booking['billing_info']['email']}}</a></td>
                                    </tr>
                                    <tr>
                                        <td>Reference: </td>
                                        <td>CC-{{$booking['id']}}</td>
                                    </tr>
                                    <tr>
                                        <td>Phone: </td>
                                        <td>{{$booking['billing_info']['phone']}}</td>
                                    </tr>
                                    <tr>
                                        <td>Address: </td>
                                        <td>{{$booking['billing_info']['address1']}}</td>
                                    </tr>
                                    <tr>
                                        <td>Booking Time : </td>
                                        <td>{!! $booking['created_at'] !!}</td>
                                    </tr>
                                    <tr>
                                        <td>Notes: </td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td style="width:50%;border-bottom:1px solid #ccc;padding:8px 1px">
                                <table>
                                    <tbody class="text">
                                    <tr>
                                        <td>Club: </td>
                                        <td>{!! $booking['court']['club']['name'] !!}</td>
                                    </tr>
                                    <tr>
                                        <td>Address: </td>
                                        <td>{{$booking['court']['club']['address']}}</td>
                                    </tr>
                                    <tr>
                                        <td>Phone: </td>
                                        <td>{{$booking['court']['club']['phone']}}</td>
                                    </tr>
                                    <tr>
                                        <td>Court: </td>
                                        <td>{!! $booking['court_name'] !!}</td>
                                    </tr>
                                    <tr>
                                        <td>Court Type: </td>
                                        <td>{{$booking['court']['surface']['label']}}</td>
                                    </tr>
                                    <tr>
                                        <td \>Indoor/Outdoor:</td>
                                        <td>{{$booking['court']['indoor_outdoor'] == 1 ? "Indoor" : "Outdoor"}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>

                    </table>
                </div>
                <div style="background:#eff0f4;border:1px solid #e2e2e2;padding:10px;margin-top:10px;width:100%; box-sizing: border-box;">
                    <table bgcolor="#FFFFFF" border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tbody>
                        <tr bgcolor="#13234e" style="color:#fff;height:25px; text-align: left">
                            <th scope="col" style="padding:5px 5px 5px 0px">Booking Type</th>
                            <th scope="col" style="padding:5px 5px 5px 0px">Date</th>
                            <th scope="col" style="padding:5px 5px 5px 0px">Time/Length</th>
                            <th scope="col" style="padding:5px 5px 5px 0px">Cost</th>
                        </tr>
                        <tr>
                            <td style="padding:5px 0;">{{$booking['type']}}</td>
                            <td>
                                @if($booking->type == "contract")
                                    <div style="font-weight: bold">Date: {{$booking->date_range_of_contract['from']." - ".$booking->date_range_of_contract['to']}}</div>
                                    <div>Day of Week: {{dayOfWeek($booking->day_of_week)}}</div>
                                    <div>Number of Weeks: {{daysOfWeekBetween($booking->date_range_of_contract['from'],$booking->date_range_of_contract['to'],$booking->day_of_week)}}</div>
                                @else
                                    <div>{{date('l jS F Y', strtotime($booking->date))}}</div>
                                @endif
                            </td>
                            <td style="padding:5px 0;">{{format_hour($booking['hour'])}} / {{str_replace('am','',str_replace('pm','',format_hour($booking->hour_length)))}} hour</td>
                            <td style="padding:5px 0;">${{$booking['total_price_order']}}</td>
                        </tr>
                        <tr align="center">
                            <td align="right" colspan="3" style="border-bottom:1px solid #eff0f4;padding:5px">Amount other</td>
                            <td align="left" style="border-bottom:1px solid #eff0f4;padding:5px 16px 5px 5px">$0</td>
                        </tr>
                        <tr align="center">
                            <td align="right" colspan="3" style="border-bottom:1px solid #eff0f4;padding:5px"><strong>Total</strong></td>
                            <td align="left" style="border-bottom:1px solid #eff0f4;padding:5px 16px 5px 5px">
                                <strong>${{$booking['total_price_order']}}</strong>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td style="padding-top:20px"></td>
    </tr>
    <tr>
        <td align="center">Thank you for booking with Court Connect!</td>
    </tr>

    </tbody>

</table>
<style>
    .text tr td:first-child{display: block; width: 120px}
</style>
<script>
    @if(isset($print) && $print == true)
        window.print();
    @endif
</script>