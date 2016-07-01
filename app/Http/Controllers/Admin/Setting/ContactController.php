<?php
/**
 * Created by PhpStorm.
 * User: HieuLuongCong
 * Date: 30-06-02016
 * Time: 8:30 PM
 */

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\Contact;
use Illuminate\Http\Request;
use Datatables;
use Exception;

class ContactController extends Controller
{
    public function getIndex(){
        return View('admin.settings.contacts.index');
    }

    public function getDataList(Request $request)
    {
        $datatables = Datatables::eloquent(Contact::query());
        $start = $request->start; // start of page
        return $datatables
            ->addColumn('numrow', function($item) use (&$start) {
                return $start += 1;
            })
            ->addColumn('action', function ($item) {
                $text = '<a href="'.route("admin.setting.contacts.show",$item->id).'" title="View" class="action btn btn-xs btn-info" target="_SELF"><i class="fa fa-view"></i>
View</a>';
                $text .= ' <a href="'.route("admin.setting.contacts.delete",$item->id).'" title="Remove" class="action btn btn-xs btn-danger" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-remove"></i>
Remove</a>';
                return $text;
            })
            ->addColumn('messages', function ($item) {
                return truncate($item['messages'],60);
            })
            ->make(true);
    }

    public function show($id)
    {
        $item = Contact::where(['id' => $id])->first();
        if(!isset($item)){
            return redirect()->back()->with('error','Error. Data invalid');
        }
        $item->is_viewed = 1;
        $item->save();
        return View('admin.settings.contacts.view',compact('item'));
    }

    public function destroy($id = null)
    {
        try {
            $item = Contact::where(['id' => $id])->first();
            if(!isset($item)){
                return redirect()->back()->with('error','Error. Data invalid');
            }

            Contact::destroy($id);
            // Redirect to the user management page
            return redirect()->route('admin.setting.contacts')->with('success', "Delete success!");
        } catch (Exception $e) {
            // Prepare the error message
            return redirect()->route('admin.setting.contacts')->with('error', "Error");
        }
    }

}