<?php

namespace App\Http\Controllers;

use App\Repositories\SortieRepository;
use Illuminate\Http\Request;

class SortieController extends Controller
{

    protected $sortieRepository;

    public function __construct(SortieRepository $sortieRepository){
        $this->sortieRepository =$sortieRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sorties = $this->sortieRepository->getAll();
        return view('sortie.index',compact('sorties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sortie.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sorties = $this->sortieRepository->store($request->all());
        return redirect('sortie');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sortie = $this->sortieRepository->getById($id);
        return view('sortie.show',compact('sortie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sortie = $this->sortieRepository->getById($id);
        return view('sortie.edit',compact('sortie'));
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
        $this->sortieRepository->update($id, $request->all());
        return redirect('sortie');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->sortieRepository->destroy($id);
        return redirect('sortie');
    }
}
