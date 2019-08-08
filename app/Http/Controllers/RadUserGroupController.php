<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RadUserGroupProvider;
use DB;

class RadUserGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('radusergroup.index');
    }

    public function getData(Request $request)
    {
        $columns = array(
            0 => 'username',
            1 => 'groupname',
            2 => 'priority'
        );
        $totalData = RadUserGroupProvider::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if(empty($request->input('search.value')))
            {
                $posts = RadUserGroupProvider::offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
                $totalFiltered = RadUserGroupProvider::count();
            }
        else
            {
                $search = $request->input('search.value');
                // dd($search);
                $posts = RadUserGroupProvider::where('groupname', 'like', "%{$search}%")
                                ->orWhere('username', 'like', "%{$search}%")
                                ->orWhere('priority', 'like', "%{$search}%")
                                ->offset($start)
                                ->limit($limit)
                                ->orderBy($order, $dir)
                                ->get();
                $totalFiltered = RadUserGroupProvider::where('groupname', 'like', "%{$search}%")
                                ->orWhere('username', 'like', "%{$search}%")
                                ->orWhere('priority', 'like', "%{$search}%")
                                ->count();
            }		
        $data = array();
        
        if($posts){
            foreach($posts as $r){
                $nestedData['username'] = $r->username;
                $nestedData['groupname'] = $r->groupname;
                $nestedData['priority'] = $r->priority;
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
        return view('radusergroup.create');
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
            'username' => 'required',
            'groupname' => 'required',
            'priority' => 'required',
        ]);

        // Insert into database
        $radData = new RadUserGroupProvider;
        $username = $request->input('username');
        $groupname = $request->input('groupname');
        $priority = $request->input('priority');
        $radData = DB::insert('INSERT INTO radusergroup (username, groupname, priority) VALUES (?,?,?)', 
            [$username,$groupname,$priority]);
        return redirect('../public/radusergroup')->with('success', 'Data Created');
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
    // public function edit($id)
    // {
    //     $rad = RadUserGroupProvider::find($id);
    //     return view('radusergroup.edit')->with('radData', $rad);
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     $this->validate($request,[
    //         'id' => 'required',
    //         'username' => 'required',
    //         'pass' => 'required',
    //         'reply' => 'required',
    //         'authdate' => 'required',
    //     ]);

    //     // Insert into database
    //     $radData = RadUserGroupProvider::find($id);
    //     $id = $request->input('id');
    //     $username = $request->input('username');
    //     $pass = $request->input('pass');
    //     $reply = $request->input('reply');
    //     $authdate = $request->input('authdate');
    //     $radData = DB::update('UPDATE radusergroup set username = ? where id = ?', [$username,$id]);
    //     $radData = DB::update('UPDATE radusergroup set pass = ? where id = ?', [$pass,$id]);
    //     $radData = DB::update('UPDATE radusergroup set reply = ? where id = ?', [$reply,$id]);
    //     $radData = DB::update('UPDATE radusergroup set authdate = ? where id = ?', [$authdate,$id]);
    //     return redirect('../public/radusergroup')->with('success', 'Data Updated');
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     $deleted = RadUserGroupProvider::find($id);
    //     $deleted->delete();
    //     return redirect('../public/radusergroup')->with('success', 'Data Removed');
    // }
}
