<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class UserController extends Controller
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->search) {
            $users = User::search($request->search)->paginate();
        }else{
            $users = User::orderBy('id', 'ASC')->paginate(15);
        }
        $filters = $request->except('_token');
        return view('usuario.index',compact('users','filters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = route('usuario.store');
        $title  = 'Criar um novo usuário';
        $warehouses = Warehouse::where('status',true)->select(['id','description'])->get();
        return view('usuario.form', compact('action', 'title','warehouses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->except(['_token','_method']);

        User::create($data);

        return to_route('usuario.index')->with('success','Usuário cadastrado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->user->find($id);
        return view('usuario.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->user->find($id);
        $action = route('usuario.update', $user->id);
        $title  = 'Editar usuário: ' . $user->name;
        $warehouses = Warehouse::where('status',true)->select(['id','description'])->get();
        return view('usuario.form', compact('user', 'action', 'title','warehouses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = $this->user->find($id);
        // $request->validate($user->rules());
        $data = $request->except(['_token','_method']);
        $user->update($data);

        return to_route('usuario.index')->with('success','Usuário atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->user->find($id);
        $user->delete();

        return to_route('usuario.index')->with('success','Usuário removido com sucesso.');
    }

    public function exportToPdf(Request $request)
    {
        $users   = $this->user::exports($request->search);
        $dom_pdf = PDF::loadView('usuario.pdf', compact('users'));
        return $dom_pdf->download('Lista_de_usuario.pdf');
    }
}
