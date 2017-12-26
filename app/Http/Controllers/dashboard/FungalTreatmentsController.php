<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\FungalTreatment;
use Illuminate\Http\Request;

class FungalTreatmentsController extends Controller
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

        if (!empty($keyword)) {
            $fungaltreatments = FungalTreatment::where('terbinafine_gel_applied', 'LIKE', "%$keyword%")
                ->orWhere('amorolfine_applied', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $fungaltreatments = FungalTreatment::paginate($perPage);
        }

        return view('fungal-treatments.index', compact('fungaltreatments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('fungal-treatments.create');
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
        $this->validate($request, [
		]);
        $requestData = $request->all();
        
        FungalTreatment::create($requestData);

        return redirect('dashboard/fungal-treatments')->with('flash_message', 'FungalTreatment added!');
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
        $fungaltreatment = FungalTreatment::findOrFail($id);

        return view('fungal-treatments.show', compact('fungaltreatment'));
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
        $fungaltreatment = FungalTreatment::findOrFail($id);

        return view('fungal-treatments.edit', compact('fungaltreatment'));
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
        $this->validate($request, [
		]);
        $requestData = $request->all();
        
        $fungaltreatment = FungalTreatment::findOrFail($id);
        $fungaltreatment->update($requestData);

        return redirect('dashboard/fungal-treatments')->with('flash_message', 'FungalTreatment updated!');
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
        FungalTreatment::destroy($id);

        return redirect('dashboard/fungal-treatments')->with('flash_message', 'FungalTreatment deleted!');
    }
}
