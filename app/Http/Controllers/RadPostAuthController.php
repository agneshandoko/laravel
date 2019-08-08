<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RadPostAuthProvider;
use DB;

class RadPostAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('radpostauth.index');
    }

    public function getData(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'username',
            2 => 'pass',
            3 => 'reply',
            4 => 'authdate'
        );
        $totalData = RadPostAuthProvider::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if(empty($request->input('search.value')))
            {
                $posts = RadPostAuthProvider::offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
                $totalFiltered = RadPostAuthProvider::count();
            }
        else
            {
                $search = $request->input('search.value');
                // dd($search);
                $posts = RadPostAuthProvider::where('id', 'like', "%{$search}%")
                                ->orWhere('username', 'like', "%{$search}%")
                                ->orWhere('pass', 'like', "%{$search}%")
                                ->orWhere('reply', 'like', "%{$search}%")
                                ->orWhere('authdate', 'like', "%{$search}%")
                                ->offset($start)
                                ->limit($limit)
                                ->orderBy($order, $dir)
                                ->get();
                $totalFiltered = RadPostAuthProvider::where('id', 'like', "%{$search}%")
                                ->orWhere('username', 'like', "%{$search}%")
                                ->orWhere('pass', 'like', "%{$search}%")
                                ->orWhere('reply', 'like', "%{$search}%")
                                ->orWhere('authdate', 'like', "%{$search}%")
                                ->count();
            }		
        $data = array();
        
        if($posts){
            foreach($posts as $r){
                $nestedData['id'] = $r->id;
                $nestedData['username'] = $r->username;
                $nestedData['pass'] = $r->pass;
                $nestedData['reply'] = $r->reply;
                $nestedData['authdate'] = $r->authdate;
                $nestedData['action'] = "
                    <a href='".route('radpostauth.edit', ['id' => $r->id])."' class='btn btn-warning btn-xs'>Edit</a>
                    <a href='".route('radpostauth.delete', ['id' => $r->id])."' class='btn btn-danger btn-xs'>Delete</a>
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
        return view('radpostauth.create');
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
            'pass' => 'required',
            'reply' => 'required',
            'authdate' => 'required',
        ]);

        // Insert into database
        $radData = new RadPostAuthProvider;
        $id = $request->input('id');
        $username = $request->input('username');
        $pass = $request->input('pass');
        $reply = $request->input('reply');
        $authdate = $request->input('authdate');
        $radData = DB::insert('INSERT INTO radpostauth (id, username, pass, reply, authdate) VALUES (?,?,?,?,?)', 
            [$id,$username,$pass,$reply,$authdate]);
        return redirect('../public/radpostauth')->with('success', 'Data Created');
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
        $rad = RadPostAuthProvider::find($id);
        return view('radpostauth.edit')->with('radData', $rad);
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
            'pass' => 'required',
            'reply' => 'required',
            'authdate' => 'required',
        ]);

        // Insert into database
        $radData = RadPostAuthProvider::find($id);
        $id = $request->input('id');
        $username = $request->input('username');
        $pass = $request->input('pass');
        $reply = $request->input('reply');
        $authdate = $request->input('authdate');
        $radData = DB::update('UPDATE radpostauth set username = ? where id = ?', [$username,$id]);
        $radData = DB::update('UPDATE radpostauth set pass = ? where id = ?', [$pass,$id]);
        $radData = DB::update('UPDATE radpostauth set reply = ? where id = ?', [$reply,$id]);
        $radData = DB::update('UPDATE radpostauth set authdate = ? where id = ?', [$authdate,$id]);
        return redirect('../public/radpostauth')->with('success', 'Data Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = RadPostAuthProvider::find($id);
        $deleted->delete();
        return redirect('../public/radpostauth')->with('success', 'Data Removed');
    }
}
