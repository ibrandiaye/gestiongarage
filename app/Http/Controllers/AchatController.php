<?php

namespace App\Http\Controllers;

use App\Repositories\AchatRepository;
use DateTime;
use Illuminate\Http\Request;

class AchatController extends Controller
{
    protected $achatRepository;

    public function __construct(AchatRepository $achatRepository){
        $this->achatRepository =$achatRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $achats = $this->achatRepository->getAll();
        return view('achat.index',compact('achats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('achat.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request['photo']){
            $files = $request['photo'];
                $destinationPath = 'doc/'; // upload path
                $nomImage = time().".". $files->getClientOriginalExtension();
                $files->move($destinationPath, $nomImage);
                $request->merge(['document'=>$nomImage]);

            }
        $achats = $this->achatRepository->store($request->all());
        return redirect('achat');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $achat = $this->achatRepository->getById($id);
        return view('achat.show',compact('achat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $achat = $this->achatRepository->getById($id);
        return view('achat.edit',compact('achat'));
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
        if($request['photo']){
            $files = $request['photo'];
                $destinationPath = 'doc/'; // upload path
                $nomImage = time().".". $files->getClientOriginalExtension();
                $files->move($destinationPath, $nomImage);
                $request->merge(['document'=>$nomImage]);

            }
        $this->achatRepository->update($id, $request->all());
        return redirect('achat');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->achatRepository->destroy($id);
        return redirect('achat');
    }

    public function getBetweenToDate(Request $request){
        $achats =$this->achatRepository->betweenToDate($request->debut,date_modify(new DateTime($request->fin), '+1 day'));
       // dd($mouvements);
        return view('achat.index',compact('achats'));
    }
}
