<?php

namespace App\Http\Controllers;

use App\Http\Requests\editTeam;
use App\Models\Team;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\DataTables;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Team::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = route('team.edit', ['id' => $row->id]);
                    return '<a href="' . $editUrl . '" class="edit btn btn-primary btn-sm">Edit</a>' . '<button class="edit btn btn-primary btn-sm" id="delete-btn" data-id="' . $row->id . '">Delete</button';
                })
                ->addColumn('logo', function ($row) {
                    $url = URL::to('/storage/' . $row->logo);
                    return '<img src=' . $url . ' border="0" width="40" class="img-rounded" align="center" />';
                })
                ->rawColumns(['action', 'logo'])
                ->make(true);
        }

        return view('team-list');
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
        //
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
        $team = Team::find($id);
        return view('edit-team', compact('team'));
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
        try {
            $request->validate([
                'logo' => 'mimes:jpeg,png,gif|max:2048',
            ]);

            $team = Team::find($id);
            $team->name = isset($request['name']) ? $request['name'] : $team->name;
            $team->status = isset($request['status']) ? $request['status'] : $team->status;

            if ($request->hasfile('logo')) {
                if (isset($team->logo) || !empty($team->logo)) {
                    if (Storage::exists('public/' . $team->logo)) {
                        Storage::delete('public/' . $team->logo);
                    }
                }
                $file = $request->file('logo');
                $extenstion = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extenstion;
                $file->storeAs('public/images/', $filename);
                $team->logo = 'images/' . $filename;
            }
            $team->save();
            return response()->json(['redirect' => route('team.index')]);
        } catch (ValidationException $validationException) {
            return response()->json(['success' => false, 'errors' => $validationException->errors()], 422);
        } catch (\Exception $exception) {
            Log::info($exception->getMessage());
            return response()->json(['success' => false, 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $team = Team::find($id);
        if (isset($team->logo) || !empty($team->logo)) {
            if (Storage::exists('public/' . $team->logo)) {
                Storage::delete('public/' . $team->logo);
            }
        }

        if ($team->delete()) {
            return true;
        } else {
            return false;
        }
    }
}
