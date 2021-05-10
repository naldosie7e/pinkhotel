<?php

namespace App\Http\Controllers\Reservacion;

use App\Http\Requests;
use App\Models\InfoHotel;

use App\Models\Reservacione;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\CalificacionReservacion;
use App\Models\Habitacione;
use App\Models\PagoReservacione;
use Illuminate\Support\Facades\Auth;

class ReservacionesController extends Controller
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
            $reservaciones = Reservacione::with('cliente','hotel','sucursal','habitacion')->where('id_hotel', 'LIKE', "%$keyword%")
                ->orWhere('id_sucursal', 'LIKE', "%$keyword%")
                ->orWhere('id_habitacion', 'LIKE', "%$keyword%")
                ->orWhere('dias_reservacion', 'LIKE', "%$keyword%")
                ->orWhere('valor_reservacion', 'LIKE', "%$keyword%")
                ->orWhere('id_cliente', 'LIKE', "%$keyword%")
                ->orWhere('estado', 'LIKE', "%$keyword%");
        } else {
            $reservaciones = Reservacione::with('cliente','hotel','sucursal','habitacion');
        }
        if(Auth::user()->rol_id==1){
            if(!is_null(Auth::user()->clienteInfo)){
                $reservaciones->where('id_cliente',Auth::user()->clienteInfo->id);
            }else{
                $reservaciones->where('id_cliente',Auth::user()->id);
            }

        }
        $reservaciones =$reservaciones->latest()->paginate($perPage);
        return view('reservacion.reservaciones.index', compact('reservaciones'));
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
        return view('reservacion.reservaciones.create')->with($data);
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
			'id_sucursal' => 'required',
			'id_habitacion' => 'required',
			'dias_reservacion' => 'required',
			'id_cliente' => 'required'
		]);
        $datosReserva = $request->only('id_hotel', 'id_sucursal', 'id_habitacion', 'dias_reservacion','id_cliente','valor_reservacion');
        $datosReserva['estado']=1;//reservadao
        $entitycreated=Reservacione::create($datosReserva);

        $datosPago=$request->only('valor_parcial_reserva', 'medio_pago');
        $datosPago['pago_parcial']=false;
        $datosPago['valor_pago']=$datosReserva['valor_reservacion'];
        $datosPago['id_reservacion']=$entitycreated->id;
        $datosPago['fecha_pago']=Carbon::now();
        if(isset($datosPago['valor_parcial_reserva'])){
            $datosPago['pago_parcial']=true;
            $datosPago['valor_pago']=$datosPago['valor_parcial_reserva'];
        }
        PagoReservacione::create($datosPago);
        $habitacion=Habitacione::find($datosReserva['id_habitacion']);
        $habitacion->estado=2;
        $habitacion->save();

        return redirect('admin/reservaciones')->with('flash_message', 'Reservacione added!');
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
        $reservacione = Reservacione::findOrFail($id);

        return view('reservacion.reservaciones.show', compact('reservacione'));
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
        $reservacione = Reservacione::with('cliente')->findOrFail($id);
        $reservacione->numero_documento =$reservacione->cliente->numero_documento ;
        $ultimoPago=PagoReservacione::where('id_reservacion',$reservacione->id)->first();
        $reservacione->medio_pago=$ultimoPago->medio_pago;
        $hotels=InfoHotel::all();
        $data = array('hotels' =>$hotels,'reservacione'=>$reservacione);

        return view('reservacion.reservaciones.edit')->with($data);

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
			'id_sucursal' => 'required',
			'id_habitacion' => 'required',
			'dias_reservacion' => 'required',
			'id_cliente' => 'required'
		]);
        $requestData = $request->all();

        $reservacione = Reservacione::findOrFail($id);
        $reservacione->update($requestData);

        return redirect('admin/reservaciones')->with('flash_message', 'Reservacione updated!');
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
        Reservacione::destroy($id);

        return redirect('admin/reservaciones')->with('flash_message', 'Reservacione deleted!');
    }

    public function checkIn($id_reservacion){
        $reservacion=Reservacione::find($id_reservacion);
        $reservacion->estado=2;//checkin
        $reservacion->save();
        return redirect('admin/reservaciones')->with('flash_message', 'Reservacione added!');
    }
    public function checkOut($id_reservacion){
        $reservacion=Reservacione::find($id_reservacion);
        $reservacion->estado=3;//checkOut
        $reservacion->save();
        return redirect('admin/reservaciones')->with('flash_message', 'Reservacione added!');
    }

    public function validarPagoReserva($id_reservacion){
        $reservacion=Reservacione::find($id_reservacion);
        $pagosReserva=PagoReservacione::where('id_reservacion',$id_reservacion)->get();
        $valorFaltante=$reservacion->valor_reservacion;
        foreach ($pagosReserva as $key => $pago) {
            $valorFaltante-=$pago->valor_pago;
        }
        $pagado=true;
        if($valorFaltante>0){
            $pagado=false;
        }
        $response = array('pagado' => $pagado,'valorFaltante' => $valorFaltante);

        echo json_encode($response);
        exit;
    }


    public function calificarReserva(Request $request){
        $requestData = $request->all();
        CalificacionReservacion::create($requestData);
        $reservacion=Reservacione::find($request->id_reservacion);
        $reservacion->estado=4;//Calificada
        $reservacion->save();
        return redirect('admin/reservaciones')->with('flash_message', 'Reservacione added!');
    }
    public function pagoOnCheckOut(Request $request){
        $requestData = $request->all();
        $reservacion=Reservacione::find($requestData['id_reservacion']);
        $reservacion->estado=3;//Calificada
        $reservacion->save();

        $datosPago=$request->only('valor_parcial_reserva', 'medio_pago');
        $datosPago['pago_parcial']=false;
        $datosPago['valor_pago']=$requestData['pago_restante'];
        $datosPago['id_reservacion']=$requestData['id_reservacion'];
        $datosPago['fecha_pago']=Carbon::now();
        $datosPago['pago_parcial']=true;
        PagoReservacione::create($datosPago);

        return redirect('admin/reservaciones')->with('flash_message', 'Reservacione added!');
    }

}