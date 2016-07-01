<?php
/**
 * Created by PhpStorm.
 * User: HieuLuongCong
 * Date: 30-06-02016
 * Time: 8:30 PM
 */

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\Faq;
use Illuminate\Http\Request;
use Validator;
use Datatables;
use Exception;

class FaqController extends Controller
{
    public function getIndex(){
        return View('admin.settings.faqs.index');
    }

    public function getDataList(Request $request)
    {
        $datatables = Datatables::eloquent(Faq::query());
        $start = $request->start; // start of page
        return $datatables
            ->addColumn('numrow', function($item) use (&$start) {
                return $start += 1;
            })
            ->addColumn('action', function ($item) {
                $text = '<a href="'.route("admin.setting.faq.edit",$item->id).'" title="Edit" class="action btn btn-xs btn-info" target="_SELF"><i class="fa fa-edit"></i>
Edit</a>';
                $text .= ' <a href="'.route("admin.setting.faq.delete",$item->id).'" title="Remove" class="action btn btn-xs btn-danger" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-remove"></i>
Remove</a>';
                return $text;
            })
            ->addColumn('question', function ($item) {
                return truncate($item['question'],60);
            })
            ->addColumn('answer', function ($item) {
                return truncate($item['answer'],60);
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
        return View('admin.settings.faqs.create');
    }

    /**
     * User create form processing.
     *
     * @return Redirect
     */
    public function store(Request $request)
    {
        $v = Validator::make($request->all(),[
            'question' => 'required',
            'answer' => 'required'
        ]);
        if($v->fails())
        {
            return redirect()->back()->withInput()->withErrors(['messages'=>$v->errors()->all()]);
        }

        $item = new Faq;
        $item->fill($request->all());
        $item->save();

        if($item) {
            return redirect()->route('admin.setting.faq')->with('success', "Add new Faq success!");
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
        $item = Faq::where(['id' => $id])->first();
        if(!isset($item)){
            return redirect()->back()->with('error','Error. Data invalid');
        }
        // Show the page
        return View('admin.settings.faqs.edit',compact('item'));
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
            $item = Faq::where(['id' => $id])->first();
            if(!isset($item)){
                return redirect()->back()->with('error','Error. Data invalid');
            }

            $item->question = isset($request->question) ? $request->question : $item->question;
            $item->answer = isset($request->answer) ? $request->answer : $item->answer;
            //save record
            $item->save();
            return redirect()->route('admin.setting.faq')->with('success', "Update success");
        } catch (Exception $e) {
            $error = "Not found";
            return redirect()->route('admin.setting.faq')->with('error', $error);
        }

        // Redirect to the user page
        return redirect()->route('admin.setting.faq.edit', $id)->withInput()->with('error', $error);
    }

    public function destroy($id = null)
    {
        try {
            $item = Faq::where(['id' => $id])->first();
            if(!isset($item)){
                return redirect()->back()->with('error','Error. Data invalid');
            }

            Faq::destroy($id);
            // Redirect to the user management page
            return redirect()->route('admin.setting.faq')->with('success', "Delete success!");
        } catch (Exception $e) {
            // Prepare the error message
            return redirect()->route('admin.setting.faq')->with('error', "Error");
        }
    }
}