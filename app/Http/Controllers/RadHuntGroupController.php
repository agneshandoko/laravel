<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RadHuntGroupProvider;
use DB;

class RadHuntGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('radhuntgroup.index');
    }

    public function getData(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'groupname',
            2 => 'nasipaddress',
            3 => 'nasportid'
        );
        $totalData = RadHuntGroupProvider::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if(empty($request->input('search.value')))
            {
                $posts = RadHuntGroupProvider::offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
                $totalFiltered = RadHuntGroupProvider::count();
            }
        else
            {
                $search = $request->input('search.value');
                // dd($search);
                $posts = RadHuntGroupProvider::where('id', 'like', "%{$search}%")
                                ->orWhere('groupname', 'like', "%{$search}%")
                                ->orWhere('nasipaddress', 'like', "%{$search}%")
                                ->orWhere('nasportid', 'like', "%{$search}%")
                                ->offset($start)
                                ->limit($limit)
                                ->orderBy($order, $dir)
                                ->get();
                $totalFiltered = RadHuntGroupProvider::where('id', 'like', "%{$search}%")
                                ->orWhere('groupname', 'like', "%{$search}%")
                                ->orWhere('nasipaddress', 'like', "%{$search}%")
                                ->orWhere('nasportid', 'like', "%{$search}%")
                                ->count();
            }		
        $data = array();
        
        if($posts){
            foreach($posts as $r){
                $nestedData['id'] = $r->id;
                $nestedData['groupname'] = $r->groupname;
                $nestedData['nasipaddress'] = $r->nasipaddress;
                $nestedData['nasportid'] = $r->nasportid;
                $nestedData['action'] = "
                    <a href='".route('radhuntgroup.edit', ['id' => $r->id])."' class='btn btn-warning btn-xs'>Edit</a>
                    <a href='".route('radhuntgroup.delete', ['id' => $r->id])."' class='btn btn-danger btn-xs'>Delete</a>
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
        return view('radhuntgroup.create');
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
            'groupname' => 'required',
            'nasipaddress' => 'required',
            'nasportid' => 'required',
        ]);

        // Insert into database
        $radData = new RadHuntGroupProvider;
        $id = $request->input('id');
        $groupname = $request->input('groupname');
        $nasipaddress = $request->input('nasipaddress');
        $nasportid = $request->input('nasportid');
        $radData = DB::insert('INSERT INTO radhuntgroup (id, groupname, nasipaddress, nasportid) VALUES (?,?,?,?)', 
            [$id,$groupname,$nasipaddress,$nasportid]);
        return redirect('../public/radhuntgroup')->with('success', 'Data Created');
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
        $rad = RadHuntGroupProvider::find($id);
        return view('radhuntgroup.edit')->with('radData', $rad);
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
            'groupname' => 'required',
            'nasipaddress' => 'required',
            'nasportid' => 'required',
        ]);

        // Insert into database
        $radData = RadHuntGroupProvider::find($id);
        $id = $request->input('id');
        $groupname = $request->input('groupname');
        $nasipaddress = $request->input('nasipaddress');
        $nasportid = $request->input('nasportid');
        $radData = DB::update('UPDATE radhuntgroup set groupname = ? where id = ?', [$groupname,$id]);
        $radData = DB::update('UPDATE radhuntgroup set nasipaddress = ? where id = ?', [$nasipaddress,$id]);
        $radData = DB::update('UPDATE radhuntgroup set nasportid = ? where id = ?', [$nasportid,$id]);
        return redirect('../public/radhuntgroup')->with('success', 'Data Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = RadHuntGroupProvider::find($id);
        $deleted->delete();
        return redirect('../public/radhuntgroup')->with('success', 'Data Removed');
    }
}