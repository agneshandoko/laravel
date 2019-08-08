<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RadCheckProvider;
use DB;

class RadCheckController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('radcheck.index');
    }

    public function getData(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'username',
            2 => 'attribute',
            3 => 'op',
            4 => 'value'
        );
        $totalData = RadCheckProvider::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if(empty($request->input('search.value')))
            {
                $posts = RadCheckProvider::offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
                $totalFiltered = RadCheckProvider::count();
            }
        else
            {
                $search = $request->input('search.value');
                // dd($search);
                $posts = RadCheckProvider::where('id', 'like', "%{$search}%")
                                ->orWhere('username', 'like', "%{$search}%")
                                ->orWhere('attribute', 'like', "%{$search}%")
                                ->orWhere('op', 'like', "%{$search}%")
                                ->orWhere('value', 'like', "%{$search}%")
                                ->offset($start)
                                ->limit($limit)
                                ->orderBy($order, $dir)
                                ->get();
                $totalFiltered = RadCheckProvider::where('id', 'like', "%{$search}%")
                                ->orWhere('username', 'like', "%{$search}%")
                                ->orWhere('attribute', 'like', "%{$search}%")
                                ->orWhere('op', 'like', "%{$search}%")
                                ->orWhere('value', 'like', "%{$search}%")
                                ->count();
            }		
        $data = array();
        
        if($posts){
            foreach($posts as $r){
                $nestedData['id'] = $r->id;
                $nestedData['username'] = $r->username;
                $nestedData['attribute'] = $r->attribute;
                $nestedData['op'] = $r->op;
                $nestedData['value'] = $r->value;
                $nestedData['action'] = "
                    <a href='".route('radcheck.edit', ['id' => $r->id])."' class='btn btn-warning btn-xs'>Edit</a>
                    <a href='".route('radcheck.delete', ['id' => $r->id])."' class='btn btn-danger btn-xs'>Delete</a>
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
        return view('radcheck.create');
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
            'username' => 'required',
            'attribute' => 'required',
            'op' => 'required',
            'value' => 'required',
        ]);

        // Insert into database
        $radData = new RadCheckProvider;
        $id = $request->input('id');
        $username = $request->input('username');
        $attribute = $request->input('attribute');
        $op = $request->input('op');
        $value = $request->input('value');
        $radData = DB::insert('INSERT INTO radcheck (id, username, attribute, op, value) VALUES (?,?,?,?,?)', 
            [$id,$username,$attribute,$op,$value]);
        return redirect('../public/radcheck')->with('success', 'Data Created');
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
        $rad = RadCheckProvider::find($id);
        return view('radcheck.edit')->with('radData', $rad);
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
            'username' => 'required',
            'attribute' => 'required',
            'op' => 'required',
            'value' => 'required',
        ]);

        // Insert into database
        $radData = RadCheckProvider::find($id);
        $id = $request->input('id');
        $username = $request->input('username');
        $attribute = $request->input('attribute');
        $op = $request->input('op');
        $value = $request->input('value');
        $radData = DB::update('UPDATE radcheck set username = ? where id = ?', [$username,$id]);
        $radData = DB::update('UPDATE radcheck set attribute = ? where id = ?', [$attribute,$id]);
        $radData = DB::update('UPDATE radcheck set op = ? where id = ?', [$op,$id]);
        $radData = DB::update('UPDATE radcheck set value = ? where id = ?', [$value,$id]);
        return redirect('../public/radcheck')->with('success', 'Data Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = RadCheckProvider::find($id);
        $deleted->delete();
        return redirect('../public/radcheck')->with('success', 'Data Removed');
    }
}
