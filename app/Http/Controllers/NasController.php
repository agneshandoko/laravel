<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NasProvider;
use DB;

class NasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // cara lainnya
        // $nasData = NasProvider::all();
        // $nasData = NasProvider::orderBy('id', 'asc')->get();
        $nasData = NasProvider::orderBy('id', 'asc')->paginate(5);
        // $nasData = NasProvider::orderBy('id', 'asc')->take(2)->get();
        // return NasProvider::where('id', 2)->get();
        // $nasData = DB::select('SELECT * FROM nas');
        return view('nas.index')->with('nasData', $nasData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('nas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'id' => 'required',
            'name' => 'required',
            'shortname' => 'required',
            'type' => 'required',
            'secret' => 'required',
            'description' => 'required',
        ]);

        // Insert into database
        $nasData = new NasProvider;
        $id = $request->input('id');
        $nasname = $request->input('name');
        $shortname = $request->input('shortname');
        $type = $request->input('type');
        $secret = $request->input('secret');
        $description = $request->input('description');
        $nasData = DB::insert('INSERT INTO nas (id, nasname, shortname, type, secret, description) VALUES (?,?,?,?,?,?)', 
            [$id,$nasname,$shortname,$type,$secret,$description]);
        return redirect('../public/nastable')->with('success', 'Data Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $nas = NasProvider::find($id);
        return view('nas.show')->with('nasData', $nas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nas = NasProvider::find($id);
        return view('nas.edit')->with('nasData', $nas);
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
        $this->validate($request,[
            'id' => 'required',
            'name' => 'required',
            'shortname' => 'required',
            'type' => 'required',
            'secret' => 'required',
            'description' => 'required',
        ]);

        // Insert into database
        $nasData = NasProvider::find($id);
        $id = $request->input('id');
        $nasname = $request->input('name');
        $shortname = $request->input('shortname');
        $type = $request->input('type');
        $secret = $request->input('secret');
        $description = $request->input('description');
        $nasData = DB::update('UPDATE nas set nasname = ? where id = ?', [$nasname,$id]);
        $nasData = DB::update('UPDATE nas set shortname = ? where id = ?', [$shortname,$id]);
        $nasData = DB::update('UPDATE nas set type = ? where id = ?', [$type,$id]);
        $nasData = DB::update('UPDATE nas set secret = ? where id = ?', [$secret,$id]);
        $nasData = DB::update('UPDATE nas set description = ? where id = ?', [$description,$id]);
        return redirect('../public/nastable')->with('success', 'Data Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = NasProvider::find($id);
        $deleted->delete();
        return redirect('../public/nastable')->with('success', 'Data Removed');
    }

    public function datatable()
    {
        $customers = Customer::all();
        return view('customers.datatable', compact('customers'));
    }

}
