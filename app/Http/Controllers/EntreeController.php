<?php

namespace App\Http\Controllers;

use App\Repositories\EntreeRepository;
use Illuminate\Http\Request;

class EntreeController extends Controller
{

    protected $entreeRepository;

    public function __construct(EntreeRepository $entreeRepository){
        $this->entreeRepository =$entreeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entrees = $this->entreeRepository->getAll();
        return view('entree.index',compact('entrees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('entree.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $entrees = $this->entreeRepository->store($request->all());
        return redirect('entree');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $entree = $this->entreeRepository->getById($id);
        return view('entree.show',compact('entree'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $entree = $this->entreeRepository->getById($id);
        return view('entree.edit',compact('entree'));
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
        $this->entreeRepository->update($id, $request->all());
        return redirect('entree');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->entreeRepository->destroy($id);
        return redirect('entree');
    }
}
