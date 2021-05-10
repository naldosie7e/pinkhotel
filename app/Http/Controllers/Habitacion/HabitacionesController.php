<?php

namespace App\Http\Controllers\Habitacion;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Habitacione;
use App\Models\Sucursale;
use Illuminate\Http\Request;

class HabitacionesController extends Controller
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
            $habitaciones = Habitacione::where('id_sucursal', 'LIKE', "%$keyword%")
                ->orWhere('clasificacion', 'LIKE', "%$keyword%")
                ->orWhere('valor_dia', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $habitaciones = Habitacione::latest()->paginate($perPage);
        }

        return view('habitaciones.habitaciones.index', compact('habitaciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $sucursales=Sucursale::with('hotel')->get();
        $data = array('sucursales' =>$sucursales);
        return view('habitaciones.habitaciones.create')->with($data);
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
			'id_sucursal' => 'required',
			'clasificacion' => 'required',
			'valor_dia' => 'required'
		]);
        $requestData = $request->all();

        Habitacione::create($requestData);

        return redirect('admin/habitaciones')->with('flash_message', 'Habitacione added!');
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
        $habitacione = Habitacione::findOrFail($id);

        return view('habitaciones.habitaciones.show', compact('habitacione'));
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
        $habitacione = Habitacione::findOrFail($id);
        $sucursales=Sucursale::with('hotel')->get();
        $data = array('sucursales' =>$sucursales,'habitacione'=>$habitacione);
        return view('habitaciones.habitaciones.edit')->with($data);
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
			'id_sucursal' => 'required',
			'clasificacion' => 'required',
			'valor_dia' => 'required'
		]);
        $requestData = $request->all();

        $habitacione = Habitacione::findOrFail($id);
        $habitacione->update($requestData);

        return redirect('admin/habitaciones')->with('flash_message', 'Habitacione updated!');
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
        Habitacione::destroy($id);

        return redirect('admin/habitaciones')->with('flash_message', 'Habitacione deleted!');
    }

    public function obtenerHabitaciones($id_sucursal){
        $habitaciones=Habitacione::where('id_sucursal',$id_sucursal)->get();
        $response = array('habitaciones' => $habitaciones);

        echo json_encode($response);
        exit;
    }
}