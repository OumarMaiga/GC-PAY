<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Files;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;


class FilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {
        //la vue qui devra être retourné sera adapté en circonstance avec la page voulu
        return view('dashboard');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */




     
    public function store(Request $request)
    {
       // Validate the inputs
       $request->validate([
        'libelle' => 'required',
    ]);

    // ensure the request has a file before we attempt anything else.
    if ($request->hasFile('file')) {

        $request->validate([
            'image' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
        ]);

        
        //Enregistrer le fichier localement dans un dossier document sous /storage/app/public
        $filemane=$request->get('libelle');
        $request->file->storeAs('public/Documents', $filemane);

        // Store the record, using the time which will be it's new filename identity.
        $product = new Files([
            "libelle" => $request->get('libelle'),
            "file_path" =>time().'.'.$request->file->getClientOriginalExtension(),
            "utilisateurid"=>Auth::user()->id,
            
           
        ]);
        $product->save(); // Finally, save the record.
    }

    return view('dasboard');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
