<?php

namespace App\Http\Controllers;

use App\Repositories\DepenseRepository;
use Illuminate\Http\Request;

class DepenseController extends Controller
{
    protected $depenseRepository;

    public function __construct(DepenseRepository $depenseRepository){
        $this->depenseRepository =$depenseRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $depenses = $this->depenseRepository->getAll();
        return view('depense.index',compact('depenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('depense.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $depenses = $this->depenseRepository->store($request->all());
        return redirect('depense');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $depense = $this->depenseRepository->getById($id);
        return view('depense.show',compact('depense'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $depense = $this->depenseRepository->getById($id);
        return view('depense.edit',compact('depense'));
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
        $this->depenseRepository->update($id, $request->all());
        return redirect('depense');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->depenseRepository->destroy($id);
        return redirect('depense');
    }
}
