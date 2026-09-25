<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()->paginate(5);
        return view('backend.contact.index', [
            'contacts' => $contacts,
            'page_title' => 'Contact Us'
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/u', 
                'email' => 'nullable|email|max:255', 
                'phone_no' => 'required|string|regex:/^[0-9]+$/|digits:10', 
                'service' => 'nullable|string|max:255',
                'message' => 'required|string',
            ], [
                'name.regex' => 'Only letters and spaces are allowed in the name field.',
                'phone_no.regex' => 'Phone number should only contain digits.',
                'phone_no.digits' => 'Phone number should be exactly 10 digits.',
            ]);

            $contact = new Contact;
            $contact->name = $validated['name'];
            $contact->email = $validated['email'] ?? null;
            $contact->phone_no = $validated['phone_no'];
            $contact->service = $validated['service'] ?? null;
            $contact->message = $validated['message'];
            $contact->save();
            
            return response()->json([
                'success' => true, 
                'message' => 'Your appointment request has been submitted successfully!'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Please check your input and try again.',
                'errors' => $e->errors()
            ], 422);
        }
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->back()->with('success', 'Contact message deleted successfully!');
    }
}
