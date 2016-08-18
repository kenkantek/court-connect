<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use DateTime;
use Illuminate\Http\Request;
use ZipArchive;
use Exception;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex(Request $request)
    {
        \Assets::addJavascript(['moment','daterangepicker']);
        \Assets::addStylesheets(['daterangepicker']);
        return view('admin.reports.index');
    }
    public function getData(Request $request)
    {
        $take = $request->take ?: 10;
        $data = Booking::join('courts','courts.id','=','bookings.court_id')
            ->leftJoin('payments','bookings.payment_id','=','payments.id')
            ->where('courts.club_id',$request->clubid)
            ->where('bookings.status_booking',"!=",'cancel')
            ->where(function($query) use ($request){
                if(isset($request->start_date)) {
                    $request->start_date = $dayAfter = (new DateTime($request->start_date))->modify('+1 day')->format('Y-m-d');
                    $query->where('bookings.created_at', '>=', $request->start_date);
                }
                if(isset($request->end_date)) {
                    $request->end_date = $dayAfter = (new DateTime($request->end_date))->modify('+1 day')->format('Y-m-d');
                    $query->where('bookings.created_at', '<=', $request->end_date);
                }
                if(isset($request->source) && $request->source == 1)
                    $query->where('bookings.source',1);
            })
            ->with('booked_by')
            ->selectRaw("bookings.*, courts.club_id, payments.card_type as cart_type")
            ->orderBy('created_at','desc')
            ->groupBy('bookings.token_booking')
            ->paginate($take);
        return $data;
    }

    public function getDownload(Request $request)
    {
        $data = Booking::join('courts','courts.id','=','bookings.court_id')
            ->where('courts.club_id',$request->clubid)
            ->where('bookings.status_booking',"!=",'cancel')
            ->where(function($query) use ($request){
                if(isset($request->start_date)) {
                    $request->start_date = $dayAfter = (new DateTime($request->start_date))->modify('+1 day')->format('Y-m-d');
                    $query->where('bookings.created_at', '>=', $request->start_date);
                }
                if(isset($request->end_date)) {
                    $request->end_date = $dayAfter = (new DateTime($request->end_date))->modify('+1 day')->format('Y-m-d');
                    $query->where('bookings.created_at', '<=', $request->end_date);
                }
                if(isset($request->source) && $request->source == 1)
                    $query->where('bookings.source',1);
            })
            ->select(["bookings.*",'courts.club_id'])
            ->orderBy('created_at','desc')
            ->groupBy('bookings.payment_id')
            ->get();

        $filename = "resources/admin/files/data.csv";
        $fp = fopen($filename, 'w');
        $fields[] = ["Txn Id","Txn Date/Time","Debit/Credit","Customer Name","Source","Booked By","Type","Day Trading","Amount($)"];
        $dateOfWeek = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
        foreach($data as $item){
            $tmp = [];
            $tmp[] = $item['id'];
            $tmp[] = ($item['type'] == "contract" ? $dateOfWeek[$item['day_of_week']].", ".$item['date_range_of_contract']['from']." - ".$item['date_range_of_contract']['to'] : $item['date'])
					." at ".$item['hour']." for ".$item['hour_length']."Hour";
            $tmp[] = "";
            $tmp[] = $item['billing_info']['first_name']. " ". $item['billing_info']['last_name'];
            $tmp[] = $item['source'] == 1 ? "Court Connect" : "Player booking";
            $tmp[] = $item['booked_by'];
            $tmp[] = $item['type'];
            $tmp[] = $item['created_at'];
            $tmp[] = $item['total_price'];
            $fields[] = $tmp;
        }
        foreach ($fields as $field) {
            fputcsv($fp, $field);
        }


        //zip file
        $zip = new ZipArchive();
        $password = null;
        $filename_zip = "resources/admin/files/export".date('Y-m-d-His') . ".zip";
        if($zip->open($filename_zip,ZIPARCHIVE::CREATE) === true) {
            $zip->addFile($filename,"data_report".date('Y-m-d-His').".csv");
//            if ($zip->setPassword("MySecretPassword")) {
//                $password = "MySecretPassword";
//            }
            $zip->close();
            if(file_exists($_SERVER['DOCUMENT_ROOT']."/".$filename)) {
                try {
                    unlink($_SERVER['DOCUMENT_ROOT'] . "/" . $filename);
                }catch(Exception $e){

                }
            }

            return response()->json([
                'error'=> false,
                'password'=> $password,
                'url' => url("/")."/".$filename_zip
            ]);
        }
        else
            return response()->json([
                'error'=> false,
                'url' => url("/")."/".$filename
            ]);
    }

}
