<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function storeContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10'
        ]);

        // TODO: Implement email sending
        // TODO: Save to database if needed

        return redirect()->route('contact')
            ->with('success', 'Terima kasih! Pesan Anda telah dikirim. Kami akan segera menghubungi Anda.');
    }
}
