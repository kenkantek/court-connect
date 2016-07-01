<?php

namespace App\Http\Controllers\Home;


use App\Events\UserContactEvent;
use App\Http\Controllers\Controller;
use App\Models\Setting\Contact;
use App\Models\Setting\Faq;
use App\Models\Setting\Page;
use Illuminate\Http\Request;
use Validator;

class PageController extends Controller {

    public function getViewPage($slug){
        $page = Page::where('slug',$slug)->first();
        if(isset($page)){
            return view('home.pages.page',compact('page'));
        }
        return redirect()->route('home.error');
    }

    public function getPageContactUs(){
        return view('home.pages.contact-us');
    }

    public function postPageContactUs(Request $request){
        $v = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'sometimes',
            'messages' => 'required'
        ]);
        if($v->fails())
        {
            return redirect()->back()->withInput()->withErrors(['messages'=>$v->errors()->all()]);
        }
        $item = new Contact;
        $item->fill($request->all());
        $item->save();
        event(new UserContactEvent($item->id));
        
        return redirect()->route('home.contact-us')->with(['success'=>'Thank you for leaving a message']);
    }

    public function pageFaq(){
        $data = Faq::all();
        return view('home.pages.faq',compact('data'));
    }
}