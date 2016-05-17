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
        $title = 'Dashboard Super Admin';
        return view('admin.super.index', compact('title'));
    }
    public function getClubs($skip, $limit)
    {
        return Club::with('state')->where('status', 1)->skip($skip)->take($limit)->orderBy('updated_at', 'desc')->get();
    }
    public function postCreateClub(CreateClubRequest $request)
    {
        $club = new Club;
        $club->fill($request->all());

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
            'success_msg' => 'Club <b>' . $club->name . '</b> has been created!',
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
