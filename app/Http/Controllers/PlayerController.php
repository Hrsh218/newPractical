<?php

namespace App\Http\Controllers;

use App\Http\Requests\createPlayer;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\DataTables as DataTablesDataTables;
use Yajra\DataTables\Facades\DataTables;

class PlayerController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Player::with('team')->get();
            return DataTablesDataTables::of($data)
                ->addIndexColumn()
                ->addColumn('team', function ($row) {
                    if (isset($row->team->name) || !empty($row->team->name)) {
                        return $row->team->name;
                    }
                })
                ->rawColumns(['team'])
                ->make(true);
        }

        return view('player-list');
    }

    public function create()
    {
        $teams = Team::all();
        return view('create-player', compact('teams'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'team_id' => 'required',
                'name' => 'required',
                'date_of_birth' => 'required',
                'status' => 'required'
            ]);

            $unique_no = $this->generateUniqueRandomNumber(1, 100);
            Player::create([
                'team_id' => $request->team_id,
                'name' => $request->name,
                'date_of_birth' => $request->date_of_birth,
                'status' => $request->status,
                'tshirt_no' => $unique_no
            ]);
            return response()->json(['redirect' => route('player.index')]);
        } catch (ValidationException $validationException) {
            return response()->json(['success' => false, 'errors' => $validationException->errors()], 422);
        } catch (\Exception $exception) {
            Log::info($exception->getMessage());
            return response()->json(['success' => false, 'message' => $exception->getMessage()], 500);
        }
    }


    function generateUniqueRandomNumber($min, $max, $excludeList = [])
    {
        $excludeList =  Player::select('tshirt_no')->get()->toArray();
        do {
            $randomNumber = rand($min, $max);
        } while (in_array($randomNumber, $excludeList));

        return $randomNumber;
    }
}
