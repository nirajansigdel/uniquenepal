<?php

namespace App\Http\Controllers;

use App\Models\CareerApplication;
use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CareerApplicationController extends Controller
{
    public function index()
    {
        $applications = CareerApplication::with('career')->latest()->paginate(10);
        return view('backend.career-applications.index', compact('applications'));
    }

    public function show(CareerApplication $application)
    {
        $application->load('career');
        return view('backend.career-applications.show', compact('application'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'career_id' => 'required|exists:careers,id',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'availability' => 'nullable|string',
            'why_volunteer' => 'nullable|string',
            'cv_resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'academic_certificates' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
            'additional_documents' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only([
            'career_id', 'full_name', 'email', 'phone', 'availability', 'why_volunteer'
        ]);

        // Handle file uploads
        if ($request->hasFile('cv_resume')) {
            $data['cv_resume'] = $request->file('cv_resume')->store('applications/cv', 'public');
        }

        if ($request->hasFile('academic_certificates')) {
            $data['academic_certificates'] = $request->file('academic_certificates')->store('applications/certificates', 'public');
        }

        if ($request->hasFile('additional_documents')) {
            $data['additional_documents'] = $request->file('additional_documents')->store('applications/documents', 'public');
        }

        CareerApplication::create($data);

        return redirect()->back()->with('success', 'Application submitted successfully!');
    }

    public function updateStatus(Request $request, CareerApplication $application)
    {
        $request->validate([
            'status' => 'required|in:pending,reviewed,accepted,rejected,completed',
            'admin_notes' => 'nullable|string'
        ]);

        $application->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes
        ]);

        return redirect()->back()->with('success', 'Application status updated successfully!');
    }

    public function destroy(CareerApplication $application)
    {
        // Delete uploaded files
        if ($application->cv_resume) {
            Storage::disk('public')->delete($application->cv_resume);
        }
        if ($application->academic_certificates) {
            Storage::disk('public')->delete($application->academic_certificates);
        }
        if ($application->additional_documents) {
            Storage::disk('public')->delete($application->additional_documents);
        }

        $application->delete();

        return redirect()->route('admin.career-applications.index')->with('success', 'Application deleted successfully!');
    }
}
