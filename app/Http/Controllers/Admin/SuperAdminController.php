<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateClubRequest;
use App\Http\Requests\EditClubRequest;
use App\Models\Contexts\Club;
use App\Repositories\Interfaces\Admin\ClubInterface;
use File;
use Illuminate\Http\Request;
use Image;

class SuperAdminController extends Controller
{
    public function __construct(ClubInterface $clubRepository)
    {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->clubRepository = $clubRepository;

    }

    public function getIndex()
    {
        \Assets::addJavascript(['select2', 'uniform', 'monthly', 'moment', 'timepicker', 'datetimepicker', 'daterangepicker', 'bootstrap-multiselect','apimap','geocomplete']);
        \Assets::addStylesheets(['select2', 'uniform', 'monthly', 'timepicker', 'datetimepicker', 'daterangepicker', 'bootstrap-multiselect']);
        \Assets::addAppModule(['app']);
        $title = 'Super Admin';
        return view('admin.super.index', compact('title'));
    }
    public function getClubs($skip, $limit)
    {
        $clubs = Club::with('state')->where('status', 1)->skip($skip)->take($limit)->orderBy('updated_at', 'desc')->get();
        foreach ($clubs as &$club){
            $commission_prices = json_decode($club->commission_prices);
            if(isset($commission_prices->flat_fee) && $commission_prices->flat_fee == 'true'){
                $club->flat_fee = true;
                $club->price_flat_fee = isset($commission_prices->price_flat_fee) ? $commission_prices->price_flat_fee : 0;
                $club->down_box_flat_fee = isset($commission_prices->down_box_flat_fee) ? $commission_prices->down_box_flat_fee : null;
                $club->otb_front_per = 0;
                $club->otb_front_mon = 0;
                $club->otb_back_per = 0;
                $club->otb_back_mon = 0;
                $club->ctb_front_per = 0;
                $club->ctb_front_mon = 0;
                $club->ctb_back_per = 0;
                $club->ctb_back_mon = 0;
            }else{
                $club->flat_fee = false;
                $club->price_flat_fee = 0;
                $club->down_box_flat_fee = null;
                $club->otb_front_per = isset($commission_prices->otb_front_per) ? $commission_prices->otb_front_per : 0;
                $club->otb_front_mon = isset($commission_prices->otb_front_mon) ? $commission_prices->otb_front_mon : 0;
                $club->otb_back_per = isset($commission_prices->otb_back_per) ? $commission_prices->otb_back_per : 0;
                $club->otb_back_mon = isset($commission_prices->otb_back_mon) ? $commission_prices->otb_back_mon : 0;
                $club->ctb_front_per = isset($commission_prices->ctb_front_per) ? $commission_prices->ctb_front_per : 0;
                $club->ctb_front_mon = isset($commission_prices->ctb_front_mon) ? $commission_prices->ctb_front_mon : 0;
                $club->ctb_back_per = isset($commission_prices->ctb_back_per) ? $commission_prices->ctb_back_per : 0;
                $club->ctb_back_mon = isset($commission_prices->ctb_back_mon) ? $commission_prices->ctb_back_mon : 0;
            }
        }
        return $clubs;
    }

    public function postCreateClub(CreateClubRequest $request)
    {
        $club = new Club;
        $club->fill($request->all());
        if($request->flat_fee == true){
            $commission_prices['flat_fee'] = 'true';
            $commission_prices['price_flat_fee'] = $request->price_flat_fee;
            $commission_prices['down_box_flat_fee'] = $request->down_box_flat_fee;
            $commission_prices['otb_front_per'] = 0;
            $commission_prices['otb_front_mon'] = 0;
            $commission_prices['otb_back_per'] = 0;
            $commission_prices['otb_back_mon'] = 0;
            $commission_prices['ctb_front_per'] = 0;
            $commission_prices['ctb_front_mon'] = 0;
            $commission_prices['ctb_back_per'] = 0;
            $commission_prices['ctb_back_mon'] = 0;
        }else {
            $commission_prices['otb_front_per'] = $request->otb_front_per;
            $commission_prices['otb_front_mon'] = $request->otb_front_mon;
            $commission_prices['otb_back_per'] = $request->otb_back_per;
            $commission_prices['otb_back_mon'] = $request->otb_back_mon;
            $commission_prices['ctb_front_per'] = $request->ctb_front_per;
            $commission_prices['ctb_front_mon'] = $request->ctb_front_mon;
            $commission_prices['ctb_back_per'] = $request->ctb_back_per;
            $commission_prices['ctb_back_mon'] = $request->ctb_back_mon;
        }
        $club->commission_prices = json_encode($commission_prices);

        if ($request->input('image') != '/uploads/images/clubs/no-image.jpg') {
            $destinationPath = '/uploads/images/clubs/';
            $name = str_slug($request->input('name'), "_");
            $image_club_name = $destinationPath . $name . '_' . time() . '.jpg';

            Image::make($request->input('image'))->save(public_path($image_club_name));
            $club->image = $image_club_name;
        } else {
            $club->image = '/uploads/images/clubs/no-image.jpg';
        }

        $geo = get_lat_long($club->address);
        $club->longitude = $geo['lng'];//$request->input('longitude');
        $club->latitude = $geo['lat'];//$request->input('latitude');
        $club->country = $request->input('country');
        $club->save();
        return response([
            'success_msg' => 'Club has been created!',
            'club' => $club,
        ]);
    }

    public function putEditClub(EditClubRequest $request)
    {
        $club = Club::find($request->input('id'));
        $club->fill($request->all());

        if($request->flat_fee == true){
            $commission_prices['flat_fee'] = 'true';
            $commission_prices['price_flat_fee'] = $request->price_flat_fee;
            $commission_prices['down_box_flat_fee'] = $request->down_box_flat_fee;
            $commission_prices['otb_front_per'] = 0;
            $commission_prices['otb_front_mon'] = 0;
            $commission_prices['otb_back_per'] = 0;
            $commission_prices['otb_back_mon'] = 0;
            $commission_prices['ctb_front_per'] = 0;
            $commission_prices['ctb_front_mon'] = 0;
            $commission_prices['ctb_back_per'] = 0;
            $commission_prices['ctb_back_mon'] = 0;
        }else {
            $commission_prices['otb_front_per'] = $request->otb_front_per;
            $commission_prices['otb_front_mon'] = $request->otb_front_mon;
            $commission_prices['otb_back_per'] = $request->otb_back_per;
            $commission_prices['otb_back_mon'] = $request->otb_back_mon;
            $commission_prices['ctb_front_per'] = $request->ctb_front_per;
            $commission_prices['ctb_front_mon'] = $request->ctb_front_mon;
            $commission_prices['ctb_back_per'] = $request->ctb_back_per;
            $commission_prices['ctb_back_mon'] = $request->ctb_back_mon;
        }
        
        $club->commission_prices = json_encode($commission_prices);

        if ($request->input('image') != $club->image) {
            File::delete($club->image);
            $name = str_slug($request->input('name'), "_");
            $filename = $name . '_' . time() . '.jpg';
            $path = public_path('uploads/images/clubs/' . $filename);

            Image::make($request->input('image'))->save($path);
            $club->image = '/uploads/images/clubs/' . $filename;
        }
        $geo = get_lat_long($club->address);
        $club->longitude = $geo['lng'];//$request->input('longitude');
        $club->latitude = $geo['lat'];//$request->input('latitude');

        $club->save();
        return response([
            'success_msg' => 'Club <b>' . $club->name . '</b> has been updated!',
        ]);
    }

    public function deleteClub(Request $request)
    {
        if ($request->input('image') != '/uploads/images/clubs/no-image.jpg') {
            File::delete($request->input('image'));
        }
        $nameClub = $request->input('name');
        $club = Club::find($request->input('id'))->delete();
        return response([
            'success_msg' => 'Club ' . $nameClub . ' has been deleted',
        ]);
    }

}
