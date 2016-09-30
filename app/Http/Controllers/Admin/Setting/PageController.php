<?php
/**
 * Created by PhpStorm.
 * User: HieuLuongCong
 * Date: 30-06-02016
 * Time: 8:30 PM
 */

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\Page;
use Illuminate\Http\Request;
use Validator;
use Datatables;
use Exception;
use View;

class PageController extends Controller
{
    public function __construct()
    {
        $title = 'Content Management | Pages';
        View::share(compact('title'));
    }

    public function getIndex(){
        return View('admin.settings.pages.index');
    }

    public function getDataList(Request $request)
    {
        $datatables = Datatables::eloquent(Page::query());
        $start = $request->start; // start of page
        return $datatables
            ->addColumn('numrow', function($item) use (&$start) {
                return $start += 1;
            })
            ->addColumn('action', function ($item) {
                $text = '<a href="'.route("admin.setting.pages.edit",$item->id).'" title="Edit" class="action btn btn-xs btn-info" target="_SELF"><i class="fa fa-edit"></i>
Edit</a>';
                $text .= ' <a href="'.route("admin.setting.pages.delete",$item->id).'" title="Remove" class="action btn btn-xs btn-danger" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-remove"></i>
Remove</a>';
                return $text;
            })
            ->addColumn('description', function ($item) {
                return truncate($item['description'],60);
            })
            ->make(true);
    }

    /**
     * Create new user
     *
     * @return View
     */
    public function create()
    {
        // create the page
        return View('admin.settings.pages.create');
    }

    /**
     * User create form processing.
     *
     * @return Redirect
     */
    public function store(Request $request)
    {
        $v = Validator::make($request->all(),[
            'title' => 'required',
            'description' => 'required'
        ]);
        if($v->fails())
        {
            return redirect()->back()->withInput()->withErrors(['messages'=>$v->errors()->all()]);
        }

        $item = new Page;
        $item->fill($request->all());
        $item->slug = unicode_convert($request->title);
        $item->save();

        if($item) {
            return redirect()->route('admin.setting.pages')->with('success', "Add new page success!");
        }
        // Redirect to the user creation page
        return Redirect::back()->withInput()->with('error', "Error");
    }

    /**
     *  update.
     *
     * @param  int $id
     * @return View
     */

    //edit
    public function edit($id)
    {
        $item = Page::where(['id' => $id])->first();
        if(!isset($item)){
            return redirect()->back()->with('error','Error. Data invalid');
        }
        // Show the page
        return View('admin.settings.pages.edit',compact('item'));
    }

    /**
     * update form processing page.
     *
     * @param  User $user
     * @param UserRequest $request
     * @return Redirect
     */
    public function update($id, Request $request)
    {

        try {
            $item = Page::where(['id' => $id])->first();
            if(!isset($item)){
                return redirect()->back()->with('error','Error. Data invalid');
            }

            $item->title = isset($request->title) ? $request->title : $item->title;
            $item->description = isset($request->description) ? $request->description : $item->description;
            //save record
            $item->save();
            return redirect()->route('admin.setting.pages')->with('success', "Update success");
        } catch (Exception $e) {
            $error = "Not found";
            return redirect()->route('admin.setting.pages')->with('error', $error);
        }

        // Redirect to the user page
        return redirect()->route('admin.setting.pages.edit', $id)->withInput()->with('error', $error);
    }

    public function destroy($id = null)
    {
        try {
            $item = Page::where(['id' => $id])->first();
            if(!isset($item)){
                return redirect()->back()->with('error','Error. Data invalid');
            }

            Page::destroy($id);
            // Redirect to the user management page
            return redirect()->route('admin.setting.pages')->with('success', "Delete success!");
        } catch (Exception $e) {
            // Prepare the error message
            return redirect()->route('admin.setting.pages')->with('error', "Error");
        }
    }
}