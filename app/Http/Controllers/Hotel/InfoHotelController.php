<?php

namespace App\Http\Controllers\Hotel;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\InfoHotel;
use Illuminate\Http\Request;

class InfoHotelController extends Controller
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
            $infohotel = InfoHotel::where('codigo', 'LIKE', "%$keyword%")
                ->orWhere('nit', 'LIKE', "%$keyword%")
                ->orWhere('nombre', 'LIKE', "%$keyword%")
                ->orWhere('fecha_creacion', 'LIKE', "%$keyword%")
                ->orWhere('representante_legal', 'LIKE', "%$keyword%")
                ->orWhere('telefono', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $infohotel = InfoHotel::latest()->paginate($perPage);
        }

        return view('hoteles.info-hotel.index', compact('infohotel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('hoteles.info-hotel.create');
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

        InfoHotel::create($requestData);

        return redirect('admin/info-hotel')->with('flash_message', 'InfoHotel added!');
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
        $infohotel = InfoHotel::findOrFail($id);

        return view('hoteles.info-hotel.show', compact('infohotel'));
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
        $infohotel = InfoHotel::findOrFail($id);

        return view('hoteles.info-hotel.edit', compact('infohotel'));
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

        $infohotel = InfoHotel::findOrFail($id);
        $infohotel->update($requestData);

        return redirect('admin/info-hotel')->with('flash_message', 'InfoHotel updated!');
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
        InfoHotel::destroy($id);

        return redirect('admin/info-hotel')->with('flash_message', 'InfoHotel deleted!');
    }

}
