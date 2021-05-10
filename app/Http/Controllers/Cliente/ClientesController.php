<?php

namespace App\Http\Controllers\Cliente;

use App\User;
use App\Http\Requests;

use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ClientesController extends Controller
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
            $clientes = Cliente::where('users_id', 'LIKE', "%$keyword%")
                ->orWhere('numero_documento', 'LIKE', "%$keyword%")
                ->orWhere('nombre', 'LIKE', "%$keyword%")
                ->orWhere('apellidos', 'LIKE', "%$keyword%")
                ->orWhere('genero', 'LIKE', "%$keyword%")
                ->orWhere('edad', 'LIKE', "%$keyword%")
                ->orWhere('fecha_nacimiento', 'LIKE', "%$keyword%")
                ->orWhere('correo_electronico', 'LIKE', "%$keyword%")
                ->orWhere('telefono', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $clientes = Cliente::latest()->paginate($perPage);
        }

        return view('cliente.clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('cliente.clientes.create');
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
			'numero_documento' => 'required',
			'nombre' => 'required',
			'apellidos' => 'required',
			'genero' => 'required',
			'edad' => 'required',
			'correo_electronico' => 'required',
			'telefono' => 'required'
		]);
        $requestData = $request->all();
        $user=User::where('email',$requestData['correo_electronico'])->first();
        if(!is_null($user)){
            $requestData['users_id']=$user->id;
        }
        Cliente::create($requestData);
        if(Auth::user()->rol_id==1){
            return redirect('admin/reservaciones')->with('flash_message', 'Cliente added!');
        }

        return redirect('admin/clientes')->with('flash_message', 'Cliente added!');
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
        $cliente = Cliente::findOrFail($id);

        return view('cliente.clientes.show', compact('cliente'));
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
        $cliente = Cliente::findOrFail($id);

        return view('cliente.clientes.edit', compact('cliente'));
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
			'numero_documento' => 'required',
			'nombre' => 'required',
			'apellidos' => 'required',
			'genero' => 'required',
			'edad' => 'required',
			'correo_electronico' => 'required',
			'telefono' => 'required'
		]);
        $requestData = $request->all();

        $cliente = Cliente::findOrFail($id);
        $cliente->update($requestData);

        return redirect('admin/clientes')->with('flash_message', 'Cliente updated!');
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
        Cliente::destroy($id);

        return redirect('admin/clientes')->with('flash_message', 'Cliente deleted!');
    }

    public function obtenerCliente($numeroDocumento){
        $cliente=Cliente::where('numero_documento',$numeroDocumento)->first();
        $response = array('cliente' => $cliente);
        echo json_encode($response);
        exit;
    }
}
