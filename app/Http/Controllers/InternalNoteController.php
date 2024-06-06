<?php

namespace App\Http\Controllers;

use App\Models\InternalNote;
use Illuminate\Http\Request;

class InternalNoteController extends Controller
{

    public function getInternalNotesByLead(Request $request, $lead){
        $internalNotes = InternalNote::get();
        return response()->json($internalNotes, 200);
    }
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
    public function store(Request $request)
    {

      try {
        $data = InternalNote::create([
          'lead_id' => $request->lead_id,
          'user_id' => $request->user_id,
          'message' => $request->message
        ]);
        return response()->json($data, 200);
      } catch (\Throwable $th) {
        return response()->json('Service Error : ' . $th , 500);
      }
    }

    /**
     * Display the specified resource.
     */
    public function show(InternalNote $internalNote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InternalNote $internalNote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InternalNote $internalNote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InternalNote $internalNote)
    {
        //
    }
}
