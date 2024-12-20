<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Comment;
use App\Models\User;
use App\Models\Response;
use App\Models\ResponseProgress;
use Illuminate\Support\Facades\Auth;


class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function dashboard()
    {
        $reports = Report::with('response.response_progress')->get();
        $responses = Response::all();
        $response_progresses = ResponseProgress::all();

        return view('reports.dashboard', compact('reports', 'responses', 'response_progresses'));
    }

    public function monitoring()
{
    $reports = Report::all();

    return view('staff.monitoring', compact('reports'));
}

    public function index()
    {

        return view('reports.beranda');
    }

    public function artikel()
    {
        $reports = Report::all();

        return view('reports.artikel', compact('reports'));
    }

    public function search()
    {
        $provinceId = $request->input('search');

        if (!$provinceId) {
            return response()->json(['error' => 'Provinsi tidak dipilih'], 400);
        }

        $reports = Report::whereRaw('JSON_UNQUOTE(JSON_EXTRACT(province, "$.id")) = ?', [$provinceId])->get();

        if ($reports->isEmpty()) {
            return response()->json(['error' => 'Tidak ada laporan ditemukan untuk provinsi ini'], 404);
        }

        return response()->json($reports);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('reports.create');  
    }

    public function searchByProvince(Request $request)
    {
        $provinceId = $request->input('search');

        if(!$provinceId) {
            return response()->json(['error' => 'Provinsi tidak dipilih'], 400);
        }

        $reports = Report::whereRaw('JSON_UNQUOTE(JSON_EXTRACT(province, "$.id")) = ?', [$provinceId])->get();

        if ($reports->isEmpty()) {
            return response()->json(['error' => 'Tidak ada laporan ditemukan untuk provinsi ini'], 404);
        }

        return response()->json($reports);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'type' => 'required',
            'province' => 'required',
            'regency' => 'required',
            'subdistrict' => 'required',
            'village' => 'required',
            'image' => 'required',
        ]);

        $file = $request->file('image');
        $filePath = $file->storeAs('uploads', time() . '_' . $file->getClientOriginalName(), 'public');
        
        $process = Report::create([
            'user_id' => Auth::user()->id,
            'description' => $request->description,
            'type' => $request->type,
            'province' => $request->province,
            'regency' => $request->regency,
            'subdistrict' => $request->subdistrict,
            'village' => $request->village,
            'image' => $filePath,
            'statement' => 1,
        ]);

        if ($process) {
            return redirect()->route('reports.create')->with('success', 'Artikel berhasil diunggah');
        } else {
            return redirect()->back()->with('failed', 'Artikel gagal ditambahkan! silahkan coba lagi kembali');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $report = Report::find($id);

        if ($report) {
            $comments = Comment::where('report_id', $report->id)->get();

            $reports = Report::where('id', $report->id)->get();
        } else {
            $reports = [];
            $comments = [];
        }

        return view('comment.index', compact('reports', 'comments'));
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
    public function destroy($id)
    {

        $report = Report::find($id);

        if (!$report) {
            return redirect()->route('dashboard')->with('error', 'Laporan tidak ditemukan');
        }
    
        $report->delete();
    
        return redirect()->route('dashboard')->with('success', 'Laporan berhasil dihapus');
    }

    public function viewers($id)
    {
         $report = Report::findOrFail($id);

         $report->increment('viewers');
 
         $voting = json_decode($report->voting, true);
         $likeCount = $voting['like'] ?? 0; 
 
         return view('report.artikel', compact('report', 'likeCount'));
    }

    public function voting($id)
    {
        $request->validate([
            'vote_type' => 'required|in:like',
        ]);

        $report = Report::findOrFail($id);

        $voting = json_decode($report->voting, true);

        if ($request->vote_type == 'like') {
            $voting['like'] = ($voting['like'] ?? 0) + 1; 
        }

        $report->voting = json_encode($voting); 

        $report->save();

        return redirect()->route('report.show', $report->id)
                         ->with('success', 'Vote berhasil!');    
    }
        
}
