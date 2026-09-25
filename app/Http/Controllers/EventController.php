<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Backend - List all FAQs with pagination
     */
    public function index()
    {
        $faqs = Faq::latest()->paginate(10);
        return view('backend.faq.index', compact('faqs'));
    }

    /**
     * Backend - Show create form
     */
    public function create()
    {
        return view('backend.faq.create');
    }

    /**
     * Backend - Store new FAQ
     */
 public function store(Request $request)
{
    $request->validate([
        'heading' => 'required|string',
        'answer' => 'required|string',
    ]);

    $data = $request->only(['heading', 'answer']);

    Faq::create($data);

    return redirect()->route('admin.faqs.index')->with('success', 'FAQ created successfully.');
}


    /**
     * Backend - Show edit form
     */
    public function edit(Faq $faq)
    {
        return view('backend.faq.edit', compact('faq'));
    }

    /**
     * Backend - Update existing FAQ
     */
    public function update(Request $request, Faq $faq)
{
    $request->validate([

        'heading' => 'required|string', // Include if question is required
        'answer' => 'required|string',
    ]);

    // Only these fields will be updated
    $data = $request->only([ 'heading', 'answer']);

    $faq->update($data);

    return redirect()->route('admin.faqs.index')->with('success', 'FAQ updated successfully.');
}


    /**
     * Backend - Delete FAQ
     */
    public function destroy(Faq $faq)
    {
        // Delete image if exists
        if ($faq->image && Storage::disk('public')->exists($faq->image)) {
            Storage::disk('public')->delete($faq->image);
        }

        $faq->delete();

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ deleted successfully.');
    }

    /**
     * Frontend - Display FAQs dynamically
     */
    public function frontendIndex()
    {
        $faqs = Faq::latest()->get();
        return view('frontend.faq.index', compact('faqs'));
    }
}
