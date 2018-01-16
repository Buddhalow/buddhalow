<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Saving;
use Illuminate\Http\Request;

class SavingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;
        $escalation_point = 133500;
        $total = Saving::all()->sum('amount');
        $deposited = (int)Saving::where('reservation', 0)->sum('amount');
        $reserved = (int)Saving::where('reservation', 1)->sum('amount');
        if (!empty($keyword)) {
            $transactions = Saving::where('name', 'LIKE', "%$keyword%")
                ->where('reservation', '0')
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->orWhere('amount', 'LIKE', "%$keyword%")
                ->orWhere('amount', 'LIKE', "%$keyword%")->orderBy('time', 'DESC')
                
                ->paginate($perPage);
            $reservations = Saving::where('name', 'LIKE', "%$keyword%")
                ->where('reservation', '0')
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->orWhere('amount', 'LIKE', "%$keyword%")
                ->orWhere('amount', 'LIKE', "%$keyword%")->orderBy('time', 'DESC')
                
                ->paginate($perPage);
        } else {
            $transactions = Saving::orderBy('time', 'DESC')->paginate($perPage)->where('reservation', 0);
            $reservations = Saving::orderBy('time', 'DESC')->paginate($perPage)->where('reservation', 1);
        }

        return response()->json(compact('transactions', 'total', 'escalation_point', 'reservations', 'reserved', 'deposited'), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('dashboard.savings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        Saving::create($requestData);

        return redirect('dashboard/savings')->with('flash_message', 'Saving added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $saving = Saving::findOrFail($id);

        return view('dashboard.savings.show', compact('saving'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $saving = Saving::findOrFail($id);

        return view('dashboard.savings.edit', compact('saving'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $saving = Saving::findOrFail($id);
        $saving->update($requestData);

        return redirect('dashboard/savings')->with('flash_message', 'Saving updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Saving::destroy($id);

        return redirect('dashboard/savings')->with('flash_message', 'Saving deleted!');
    }
}