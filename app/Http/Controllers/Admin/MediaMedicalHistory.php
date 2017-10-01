<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Contracts\Repositories\PatientRepository;
use App\Eloquent\User;
use Video;
use App\Eloquent\MedicalHistory;
class MediaMedicalHistory extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $video = new Video();
        $history = $video->saveHistory($request);
        if($video->saveMedia($history, $request)) {
            return redirect()->route('patient.index')->with('message',"Thêm thành công");
        }
        $history->delete();
        return redirect()->route('patient.index')->with('danger',"Video không hợp lệ");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        echo $id;
        // $history = MedicalHistory::findorFail($id);
        // $extension = Video::update($request->file('video'), $history->media->name);
        // if($extension) {
        //   $history->content = $request->content;
        //   $history->save();
        //   $history->media()->update([
        //     'type' => $extension
        //   ]);
        //   return back()->with(['success' => 'Cập nhật thành công']);
        // }
        // return back()->withErrors('Video không hợp lệ.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        echo $id;
        // $history = MedicalHistory::findorFail($id);
        // if($history->delete())
        // return back()->with(['success' => 'Cập nhật thành công']);
    }
}
