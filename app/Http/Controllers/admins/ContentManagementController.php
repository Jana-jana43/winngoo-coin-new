<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\PrivacyPolicy;
use Illuminate\Support\Facades\DB;
use App\Models\TermsCondition;
use App\Models\News;
use App\Models\About;
class ContentManagementController extends Controller
{
    //sowmiya

//     public function faq()
// {
//     $faqs = Faq::latest()->get(); 
//     return view('admin.contentManagement.manage-faq', compact('faqs'));
// }

public function faq()
{
    $faqs = Faq::orderBy('id', 'asc')->get(); 
    return view('admin.contentManagement.manage-faq', compact('faqs'));
}
     public function createFaq()
    {

        $lastId = \App\Models\Faq::max('id'); // get last id
    $nextId = $lastId ? $lastId + 1 : 1;  // increment
        return view('admin.contentManagement.create-faq', compact('nextId'));
    }


public function editFaq($id)
{
    $faq = Faq::findOrFail($id); // get single FAQ
    return view('admin.contentManagement.edit-faq', compact('faq'));
}
    public function store(Request $request)
{


    $request->validate([
        'question' => 'required|string',
        'answer' => 'required|string',
    ]);

    Faq::create([
        'question' => $request->question,
        'answer' => $request->answer,
        'status' => $request->status ?? 'inactive',
    ]);

    return redirect()->route('admin.faq')
        ->with('success', 'FAQ Created Successfully');
}
public function update(Request $request, $id)
{
    $request->validate([
        'question' => 'required',
        'answer' => 'required',
    ]);

    $faq = Faq::findOrFail($id);

    $faq->update([
        'question' => $request->question,
        'answer' => $request->answer,
        'status' => $request->status ?? 'inactive',
    ]);

    return redirect()->route('admin.faq')
        ->with('success', 'FAQ Updated Successfully');
}

public function delete($id)
{
    $faq = Faq::findOrFail($id);
    $faq->delete();

    return redirect()->back()->with('success', 'FAQ deleted successfully');
}

public function updateStatus(Request $request, $id)
{
    $faq = Faq::findOrFail($id);
    $faq->status = $request->status;
    $faq->save();

    return response()->json(['success' => true]);
}

public function managePrivacyPolicy()
{
    $privacy = PrivacyPolicy::first(); // fetch data

    return view('admin.contentManagement.manage-privacypolicy', compact('privacy'));
}

public function savePrivacy(Request $request)
{
    $request->validate([
        'content' => 'required'
    ]);

    // Save logic
    DB::table('privacy_policies')->updateOrInsert(
        ['id' => 1],
        ['content' => $request->content]
    );

    return back()->with('success', 'Privacy Policy Saved Successfully');
}



public function manageTermsAndConditions()
{
    $terms = TermsCondition::first(); 

    return view('admin.contentManagement.manage-termsandconditions', compact('terms'));
}

public function saveTerms(Request $request)
{
    $request->validate([
        'content' => 'required'
    ]);

    TermsCondition::updateOrCreate(
        ['id' => 1],
        ['content' => $request->content]
    );

    return back()->with('success', 'Terms & Conditions Saved Successfully');
}
public function manageNews()

{
    $news = News::first();
    return view('admin.contentManagement.manage-news', compact('news'));
}
public function saveNews(Request $request)
{
    $request->validate([
        'content' => 'required'
    ], [
        'content.required' => 'News content is required!'
    ]);

    News::updateOrCreate(
        ['id' => 1],
        ['content' => $request->content]
    );

    return back()->with('success', 'News Saved Successfully');
}


public function manageAbout()
{
    $about = DB::table('abouts')->first();
    return view('admin.contentManagement.manage-about',compact('about'));

}

public function storeAbout(Request $request)
{
    // Remove HTML tags and spaces
    $plainText = trim(strip_tags($request->content));

    if (empty($plainText)) {
        return redirect()->back()
            ->withErrors(['content' => 'Content is required'])
            ->withInput();
    }

    About::updateOrCreate(
        ['id' => 1],
        ['content' => $request->content]
    );

    return redirect()->back()->with('success', 'Data Saved Successfully');
}


}