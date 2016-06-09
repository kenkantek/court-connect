<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\City;
use App\Models\Deal;
use App\Models\Zipcode;
use App\Models\CourtRate;
use App\Services\GoogleCalendar;
use Carbon\Carbon;
use Exception;
use Google_Client;
use Google_Service_Calendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{

    public function getIndex()
    {
//        $calendar = new GoogleCalendar();
//        $calendarId = "YourCalendarID";
//        $result = $calendar->get($calendarId);
        $deals = getDeals();
        return view('home.pages.index',compact('deals'));
    }

    /**
     * Expands the home directory alias '~' to the full path.
     * @param string $path the path to expand.
     * @return string the expanded path.
     */
    function expandHomeDirectory($path) {
        $homeDirectory = getenv('HOME');
        if (empty($homeDirectory)) {
            $homeDirectory = getenv("HOMEDRIVE") . getenv("HOMEPATH");
        }
        return str_replace('~', realpath($homeDirectory), $path);
    }

    function getClient() {
        $client = new Google_Client();
        $client->setApplicationName(APPLICATION_NAME);
        $client->setScopes(SCOPES);
        $client->setAuthConfigFile(CLIENT_SECRET_PATH);
        $client->setAccessType('offline');

        // Load previously authorized credentials from a file.
        $credentialsPath = expandHomeDirectory(CREDENTIALS_PATH);
        if (file_exists($credentialsPath)) {
            $accessToken = file_get_contents($credentialsPath);
        } else {
            // Request authorization from the user.
            $authUrl = $client->createAuthUrl();
            printf("Open the following link in your browser:\n%s\n", $authUrl);
            print 'Enter verification code: ';
            $authCode = trim(fgets(STDIN));

            // Exchange authorization code for an access token.
            $accessToken = $client->authenticate($authCode);

            // Store the credentials to disk.
            if(!file_exists(dirname($credentialsPath))) {
                mkdir(dirname($credentialsPath), 0700, true);
            }
            file_put_contents($credentialsPath, $accessToken);
            printf("Credentials saved to %s\n", $credentialsPath);
        }
        $client->setAccessToken($accessToken);

        // Refresh the token if it's expired.
        if ($client->isAccessTokenExpired()) {
            $client->refreshToken($client->getRefreshToken());
            file_put_contents($credentialsPath, $client->getAccessToken());
        }
        return $client;
    }


    //get deals
    public function getDeals(){
        $deals = Deal::where('deals.date', '>=', date("Y-m-d"))
            ->whereIn('deals.created_at',function($query){
                $query->select(DB::raw("MAX(created_at)"))
                    ->from('deals')
                    ->groupBy("date", "court_id", "hour", "hour_length");
            })
            ->join('courts','courts.id','=','deals.court_id')
            ->join('clubs','clubs.id','=','courts.club_id')
            ->orderBy('date','asc')
            ->select(['deals.*','courts.name as court_name','clubs.name as club_name', 'clubs.city', 'clubs.state', 'clubs.image'])
            ->paginate(6);
        return view('home.pages.deals',compact('deals'));
    }

    public function getError(){

    }

    public function getAlert(){
        return view('home.pages.alert');
    }

}
