<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{
    /** 
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required',
        ]);

        $reportFormat = Report::find($id);

        $prosess = Comment::create([
            'report_id' => $reportFormat->id,
            'comment' => $request->comment,
            'user_id' => Auth::user()->id,
        ]);

        if($prosess) {
            return redirect()->back()->with('success', 'Komentar anda berhasil terkirim!');
        } else {
            return redirect()->back()->with('failed', 'Komentar anda gagal terkirim!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
