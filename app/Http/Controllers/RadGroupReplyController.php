<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RadGroupReplyProvider;
use DB;

class RadGroupReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('radgroupreply.index');
    }

    public function getData(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'groupname',
            2 => 'attribute',
            3 => 'op',
            4 => 'value'
        );
        $totalData = RadGroupReplyProvider::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if(empty($request->input('search.value')))
            {
                $posts = RadGroupReplyProvider::offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
                $totalFiltered = RadGroupReplyProvider::count();
            }
        else
            {
                $search = $request->input('search.value');
                // dd($search);
                $posts = RadGroupReplyProvider::where('id', 'like', "%{$search}%")
                                ->orWhere('groupname', 'like', "%{$search}%")
                                ->orWhere('attribute', 'like', "%{$search}%")
                                ->orWhere('op', 'like', "%{$search}%")
                                ->orWhere('value', 'like', "%{$search}%")
                                ->offset($start)
                                ->limit($limit)
                                ->orderBy($order, $dir)
                                ->get();
                $totalFiltered = RadGroupReplyProvider::where('id', 'like', "%{$search}%")
                                ->orWhere('groupname', 'like', "%{$search}%")
                                ->orWhere('attribute', 'like', "%{$search}%")
                                ->orWhere('op', 'like', "%{$search}%")
                                ->orWhere('value', 'like', "%{$search}%")
                                ->count();
            }		
        $data = array();
        
        if($posts){
            foreach($posts as $r){
                $nestedData['id'] = $r->id;
                $nestedData['groupname'] = $r->groupname;
                $nestedData['attribute'] = $r->attribute;
                $nestedData['op'] = $r->op;
                $nestedData['value'] = $r->value;
                $nestedData['action'] = "
                    <a href='".route('radgroupreply.edit', ['id' => $r->id])."' class='btn btn-warning btn-xs'>Edit</a>
                    <a href='".route('radgroupreply.delete', ['id' => $r->id])."' class='btn btn-danger btn-xs'>Delete</a>
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
        return view('radgroupreply.create');
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
            'attribute' => 'required',
            'op' => 'required',
            'value' => 'required',
        ]);

        // Insert into database
        $radData = new RadGroupReplyProvider;
        $id = $request->input('id');
        $groupname = $request->input('groupname');
        $attribute = $request->input('attribute');
        $op = $request->input('op');
        $value = $request->input('value');
        $radData = DB::insert('INSERT INTO radgroupreply (id, groupname, attribute, op, value) VALUES (?,?,?,?,?)', 
            [$id,$groupname,$attribute,$op,$value]);
        return redirect('../public/radgroupreply')->with('success', 'Data Created');
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
        $rad = RadGroupReplyProvider::find($id);
        return view('radgroupreply.edit')->with('radData', $rad);
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
            'attribute' => 'required',
            'op' => 'required',
            'value' => 'required',
        ]);

        // Insert into database
        $radData = RadGroupReplyProvider::find($id);
        $id = $request->input('id');
        $groupname = $request->input('groupname');
        $attribute = $request->input('attribute');
        $op = $request->input('op');
        $value = $request->input('value');
        $radData = DB::update('UPDATE radgroupreply set groupname = ? where id = ?', [$groupname,$id]);
        $radData = DB::update('UPDATE radgroupreply set attribute = ? where id = ?', [$attribute,$id]);
        $radData = DB::update('UPDATE radgroupreply set op = ? where id = ?', [$op,$id]);
        $radData = DB::update('UPDATE radgroupreply set value = ? where id = ?', [$value,$id]);
        return redirect('../public/radgroupreply')->with('success', 'Data Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = RadGroupReplyProvider::find($id);
        $deleted->delete();
        return redirect('../public/radgroupreply')->with('success', 'Data Removed');
    }
}