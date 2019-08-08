<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NasProvider;

class NasTableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('nastable.datatableindex');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nas = NasProvider::all();
        return view('nastable.index', compact('nas'));
    }

    public function getData(Request $request)
    {
            $columns = array(
                0 => 'id',
                1 => 'nasname',
                2 => 'shortname',
                3 => 'type',
                4 => 'ports',
                5 => 'secret',
                6 => 'server',
                7 => 'community',
                8 => 'description',
                9 => 'Action'
            );
            $totalData = NasProvider::count();
            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');
            if(empty($request->input('search.value')))
                {
                    $posts = NasProvider::offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
                    $totalFiltered = NasProvider::count();
                }
            else
                {
                    $search = $request->input('search.value');
                   // dd($search);
                    $posts = NasProvider::where('id', 'like', "%{$search}%")
                                    ->orWhere('nasname', 'like', "%{$search}%")
                                    ->orWhere('shortname', 'like', "%{$search}%")
                                    ->orWhere('type', 'like', "%{$search}%")
                                    ->orWhere('ports', 'like', "%{$search}%")
                                    ->orWhere('secret', 'like', "%{$search}%")
                                    ->orWhere('server', 'like', "%{$search}%")
                                    ->orWhere('community', 'like', "%{$search}%")
                                    ->orWhere('description', 'like', "%{$search}%")
                                    ->offset($start)
                                    ->limit($limit)
                                    ->orderBy($order, $dir)
                                    ->get();
                    $totalFiltered = NasProvider::where('id', 'like', "%{$search}%")
                                    ->orWhere('nasname', 'like', "%{$search}%")
                                    ->orWhere('shortname', 'like', "%{$search}%")
                                    ->orWhere('type', 'like', "%{$search}%")
                                    ->orWhere('ports', 'like', "%{$search}%")
                                    ->orWhere('secret', 'like', "%{$search}%")
                                    ->orWhere('server', 'like', "%{$search}%")
                                    ->orWhere('community', 'like', "%{$search}%")
                                    ->orWhere('description', 'like', "%{$search}%")
                                    ->count();
                }		
            $data = array();
            
            if($posts){
                foreach($posts as $r){
                    $nestedData['id'] = $r->id;
                    $nestedData['nasname'] = $r->nasname;
                    $nestedData['shortname'] = $r->shortname;
                    $nestedData['type'] = $r->type;
                    $nestedData['ports'] = $r->ports;
                    $nestedData['secret'] = $r->secret;
                    $nestedData['server'] = $r->server;
                    $nestedData['community'] = $r->community;
                    $nestedData['description'] = $r->description;
                    $nestedData['action'] = "
                        <a href='".route('nas.show', ['id' => $r->id])."' class='btn btn-info btn-xs'>View</a>
                        <a href='".route('nas.edit', ['id' => $r->id])."' class='btn btn-warning btn-xs'>Edit</a>
                        <a href='".route('nas.delete', ['id' => $r->id])."' class='btn btn-danger btn-xs'>Delete</a>
                    ";
                    $data[] = $nestedData;
                }
            }

            $json_data = array(
                "draw"			    => intval($request->input('draw')),
                "recordsTotal"	    => intval($totalData),
                "recordsFiltered"   => intval($totalFiltered),
                "data"			    => $data
            );
            echo json_encode($json_data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
