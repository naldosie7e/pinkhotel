<?php

namespace App\Http\Controllers\Sucursal;

use App\Http\Requests;
use App\Models\InfoHotel;

use App\Models\Sucursale;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SucursalesController extends Controller
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
            $sucursales = Sucursale::with('hotel')->where('id_hotel', 'LIKE', "%$keyword%")
                ->orWhere('codigo', 'LIKE', "%$keyword%")
                ->orWhere('direccion', 'LIKE', "%$keyword%")
                ->orWhere('fecha_creacion', 'LIKE', "%$keyword%")
                ->orWhere('telefono', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $sucursales = Sucursale::with('hotel')->latest()->paginate($perPage);
        }

        return view('sucursales.sucursales.index', compact('sucursales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $hotels=InfoHotel::all();
        $data = array('hotels' =>$hotels);
        return view('sucursales.sucursales.create')->with($data);
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
			'id_hotel' => 'required',
			'codigo' => 'required',
			'direccion' => 'required',
			'fecha_creacion' => 'required',
			'telefono' => 'required'
		]);
        $requestData = $request->all();

        Sucursale::create($requestData);

        return redirect('admin/sucursales')->with('flash_message', 'Sucursale added!');
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
        $sucursale = Sucursale::findOrFail($id);

        return view('sucursales.sucursales.show', compact('sucursale'));
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
        $sucursale = Sucursale::findOrFail($id);
        $hotels=InfoHotel::all();
        $data = array('hotels' =>$hotels,'sucursale'=>$sucursale);

        return view('sucursales.sucursales.edit')->with($data);
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
			'id_hotel' => 'required',
			'codigo' => 'required',
			'direccion' => 'required',
			'fecha_creacion' => 'required',
			'telefono' => 'required'
		]);
        $requestData = $request->all();

        $sucursale = Sucursale::findOrFail($id);
        $sucursale->update($requestData);

        return redirect('admin/sucursales')->with('flash_message', 'Sucursale updated!');
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
        Sucursale::destroy($id);

        return redirect('admin/sucursales')->with('flash_message', 'Sucursale deleted!');
    }

    public function obtenerSucursales($id_hotel){
        $sucursalesPorHotel=Sucursale::where('id_hotel',$id_hotel)->with('hotel')->get();
        $response = array('sucursales' => $sucursalesPorHotel);

        echo json_encode($response);
        exit;
    }
}
