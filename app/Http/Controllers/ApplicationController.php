<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Http;
class ApplicationController extends Controller
{
    public function store(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/u',
                'email' => 'nullable|email|max:255|ends_with:@gmail.com',
                'address' => 'nullable|string|max:255|regex:/^[a-zA-Z0-9\s]+$/u',
                'phone_no' => 'required|string|regex:/^[0-9]+$/|digits:10',
                'whatsapp_no' => 'nullable|string|regex:/^[0-9]+$/|digits:10',
                'document_proof' => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:2048',
            ], [
                'name.regex' => 'Only letters and spaces are allowed in the name field.',
                'address.regex' => 'Only letters, numbers, and spaces are allowed in the address field.',
                'phone_no.regex' => 'Phone number should only contain digits.',
                'phone_no.digits' => 'Phone number should be exactly 10 digits.',
                'whatsapp_no.regex' => 'WhatsApp number should only contain digits.',
                'whatsapp_no.digits' => 'WhatsApp number should be exactly 10 digits.',
                'email.ends_with' => 'The email must end with @gmail.com.',
            ]);

            if ($request->hasFile('document_proof')) {
                $documentProof = $request->file('document_proof');
                $documentName = time().'.'.$documentProof->getClientOriginalExtension();
                $documentProof->storeAs('public/uploads/documents', $documentName);
                $documentProof = 'uploads/documents/' . $documentName;
            } else {
                $documentProof = null;
            }

            $userDetail = new UserDetail();
            $userDetail->product_id = $id;
            $userDetail->name = $request->input('name');
            $userDetail->email = $request->input('email');
            $userDetail->address = $request->input('address');
            $userDetail->phone_no = $request->input('phone_no');
            $userDetail->whatsapp_no = $request->input('whatsapp_no');
            $userDetail->document_proof = $documentProof;
            $userDetail->status = 'pending';
            $userDetail->save();

            return redirect()->route('products.detail', ['id' => $id])->with('success', 'Application submitted successfully! We will contact you soon.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while submitting your application. Please try again.')->withInput();
        }
    }
    public function adminIndex()
{
        $userDetails = UserDetail::with('product')->get();
        return view('backend.userdetails.index', compact('userDetails'));
    }

    public function accept(Request $request)
{
    $userDetail = UserDetail::findOrFail($request->input('application_id'));
    $userDetail->status = 'approved';
    $userDetail->save();

    return response()->json(['success' => true, 'status' => 'approved']);
}

public function reject(Request $request)
{
    $userDetail = UserDetail::findOrFail($request->input('application_id'));
    $userDetail->status = 'rejected';
    $userDetail->save();

    return response()->json(['success' => true, 'status' => 'rejected']);
}
}



