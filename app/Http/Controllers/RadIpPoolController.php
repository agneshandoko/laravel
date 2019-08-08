<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RadIpPoolProvider;
use DB;

class RadIpPoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('radippool.index');
    }

    public function getData(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'pool_name',
            2 => 'framedipaddress',
            3 => 'nasipaddress',
            4 => 'calledstationid',
            5 => 'callingstationid',
            6 => 'expiry_time',
            7 => 'username',
            8 => 'pool_key'

        );
        $totalData = RadIpPoolProvider::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if(empty($request->input('search.value')))
            {
                $posts = RadIpPoolProvider::offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
                $totalFiltered = RadIpPoolProvider::count();
            }
        else
            {
                $search = $request->input('search.value');
                // dd($search);
                $posts = RadIpPoolProvider::where('id', 'like', "%{$search}%")
                                ->orWhere('pool_name', 'like', "%{$search}%")
                                ->orWhere('framedipaddress', 'like', "%{$search}%")
                                ->orWhere('nasipaddress', 'like', "%{$search}%")
                                ->orWhere('calledstationid', 'like', "%{$search}%")
                                ->orWhere('callingstationid', 'like', "%{$search}%")
                                ->orWhere('expiry_time', 'like', "%{$search}%")
                                ->orWhere('username', 'like', "%{$search}%")
                                ->orWhere('pool_key', 'like', "%{$search}%")
                                ->offset($start)
                                ->limit($limit)
                                ->orderBy($order, $dir)
                                ->get();
                $totalFiltered = RadIpPoolProvider::where('id', 'like', "%{$search}%")
                                ->orWhere('pool_name', 'like', "%{$search}%")
                                ->orWhere('framedipaddress', 'like', "%{$search}%")
                                ->orWhere('nasipaddress', 'like', "%{$search}%")
                                ->orWhere('calledstationid', 'like', "%{$search}%")
                                ->orWhere('callingstationid', 'like', "%{$search}%")
                                ->orWhere('expiry_time', 'like', "%{$search}%")
                                ->orWhere('username', 'like', "%{$search}%")
                                ->orWhere('pool_key', 'like', "%{$search}%")
                                ->count();
            }		
        $data = array();
        
        if($posts){
            foreach($posts as $r){
                $nestedData['id'] = $r->id;
                $nestedData['pool_name'] = $r->pool_name;
                $nestedData['framedipaddress'] = $r->framedipaddress;
                $nestedData['nasipaddress'] = $r->nasipaddress;
                $nestedData['calledstationid'] = $r->calledstationid;
                $nestedData['callingstationid'] = $r->callingstationid;
                $nestedData['expiry_time'] = $r->expiry_time;
                $nestedData['username'] = $r->username;
                $nestedData['pool_key'] = $r->pool_key;
                $nestedData['action'] = "
                    <a href='".route('radippool.edit', ['id' => $r->id])."' class='btn btn-warning btn-xs'>Edit</a>
                    <a href='".route('radippool.delete', ['id' => $r->id])."' class='btn btn-danger btn-xs'>Delete</a>
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('radippool.create');
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
            'pool_name' => 'required',
            'framedipaddress' => 'required',
            'nasipaddress' => 'required',
            'calledstationid' => 'required',
            'callingstationid' => 'required',
            'expiry_time' => 'required',
            'username' => 'required',
            'pool_key' => 'required',
        ]);

        // Insert into database
        $radData = new RadIpPoolProvider;
        $id = $request->input('id');
        $pool_name = $request->input('pool_name');
        $framedipaddress = $request->input('framedipaddress');
        $nasipaddress = $request->input('nasipaddress');
        $calledstationid = $request->input('calledstationid');
        $callingstationid = $request->input('callingstationid');
        $expiry_time = $request->input('expiry_time');
        $username = $request->input('username');
        $pool_key = $request->input('pool_key');
        $radData = DB::insert('INSERT INTO radippool (id, pool_name, framedipaddress, nasipaddress, calledstationid, callingstationid, expiry_time, username, pool_key) VALUES (?,?,?,?,?,?,?,?,?)', 
            [$id,$pool_name,$framedipaddress,$nasipaddress,$calledstationid,$callingstationid,$expiry_time,$username,$pool_key]);
        return redirect('../public/radippool')->with('success', 'Data Created');
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
        $rad = RadIpPoolProvider::find($id);
        return view('radippool.edit')->with('radData', $rad);
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
            'pool_name' => 'required',
            'framedipaddress' => 'required',
            'nasipaddress' => 'required',
            'calledstationid' => 'required',
            'callingstationid' => 'required',
            'expiry_time' => 'required',
            'username' => 'required',
            'pool_key' => 'required',
        ]);

        // Insert into database
        $radData = RadIpPoolProvider::find($id);

        $id = $request->input('id');
        $pool_name = $request->input('pool_name');
        $framedipaddress = $request->input('framedipaddress');
        $nasipaddress = $request->input('nasipaddress');
        $calledstationid = $request->input('calledstationid');
        $callingstationid = $request->input('callingstationid');
        $expiry_time = $request->input('expiry_time');
        $username = $request->input('username');
        $pool_key = $request->input('pool_key');
        $radData = DB::update('UPDATE radippool set pool_name = ? where id = ?', [$pool_name,$id]);
        $radData = DB::update('UPDATE radippool set framedipaddress = ? where id = ?', [$framedipaddress,$id]);
        $radData = DB::update('UPDATE radippool set nasipaddress = ? where id = ?', [$nasipaddress,$id]);
        $radData = DB::update('UPDATE radippool set calledstationid = ? where id = ?', [$calledstationid,$id]);
        $radData = DB::update('UPDATE radippool set callingstationid = ? where id = ?', [$callingstationid,$id]);
        $radData = DB::update('UPDATE radippool set expiry_time = ? where id = ?', [$expiry_time,$id]);
        $radData = DB::update('UPDATE radippool set username = ? where id = ?', [$username,$id]);
        $radData = DB::update('UPDATE radippool set pool_key = ? where id = ?', [$pool_key,$id]);
        return redirect('../public/radippool')->with('success', 'Data Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = RadIpPoolProvider::find($id);
        $deleted->delete();
        return redirect('../public/radippool')->with('success', 'Data Removed');
    }
}