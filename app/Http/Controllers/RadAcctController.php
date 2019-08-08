<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RadAcctProvider;
use DB;

class RadAcctController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('radacct.index');
    }

    public function getData(Request $request)
    {
        $columns = array(
            0 => 'radacctid',
            1 => 'acctsessionid',
            2 => 'acctuniqueid',
            3 => 'username',
            4 => 'realm',
            5 => 'nasipaddress',
            6 => 'nasportid',
            7 => 'nasporttype',
            8 => 'acctstarttime',
            9 => 'acctupdatetime',
            10 => 'acctstoptime',
            11 => 'acctinterval',
            12 => 'acctsessiontime',
            13 => 'acctauthentic',
            14 => 'connectinfo_start',
            15 => 'connectinfo_stop',
            16 => 'acctinputoctets',
            17 => 'acctoutputoctets',
            18 => 'calledstationid',
            19 => 'calingstationid',
            20 => 'acctterminatecause',
            21 => 'servicetype',
            22 => 'framedprotocol',
            23 => 'framedipaddress'
        );
        $totalData = RadAcctProvider::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if(empty($request->input('search.value')))
            {
                $posts = RadAcctProvider::offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
                $totalFiltered = RadAcctProvider::count();
            }
        else
            {
                $search = $request->input('search.value');
                // dd($search);
                $posts = RadAcctProvider::where('radacctid', 'like', "%{$search}%")
                                ->orWhere('acctsessionid', 'like', "%{$search}%")
                                ->orWhere('acctuniqueid', 'like', "%{$search}%")
                                ->orWhere('username', 'like', "%{$search}%")
                                ->orWhere('realm', 'like', "%{$search}%")
                                ->orWhere('nasipaddress', 'like', "%{$search}%")
                                ->orWhere('nasportid', 'like', "%{$search}%")
                                ->orWhere('nasporttype', 'like', "%{$search}%")
                                ->orWhere('acctstarttime', 'like', "%{$search}%")
                                ->orWhere('acctupdatetime', 'like', "%{$search}%")
                                ->orWhere('acctstoptime', 'like', "%{$search}%")
                                ->orWhere('acctinterval', 'like', "%{$search}%")
                                ->orWhere('acctsessiontime', 'like', "%{$search}%")
                                ->orWhere('acctauthentic', 'like', "%{$search}%")
                                ->orWhere('connectinfo_start', 'like', "%{$search}%")
                                ->orWhere('connectinfo_stop', 'like', "%{$search}%")
                                ->orWhere('acctinputoctets', 'like', "%{$search}%")
                                ->orWhere('acctoutputoctets', 'like', "%{$search}%")
                                ->orWhere('calledstationid', 'like', "%{$search}%")
                                ->orWhere('calingstationid', 'like', "%{$search}%")
                                ->orWhere('acctterminatecause', 'like', "%{$search}%")
                                ->orWhere('servicetype', 'like', "%{$search}%")
                                ->orWhere('framedprotocol', 'like', "%{$search}%")
                                ->orWhere('framedipaddress', 'like', "%{$search}%")
                                ->offset($start)
                                ->limit($limit)
                                ->orderBy($order, $dir)
                                ->get();
                $totalFiltered = RadAcctProvider::where('radacctid', 'like', "%{$search}%")
                                ->orWhere('acctsessionid', 'like', "%{$search}%")
                                ->orWhere('acctuniqueid', 'like', "%{$search}%")
                                ->orWhere('username', 'like', "%{$search}%")
                                ->orWhere('realm', 'like', "%{$search}%")
                                ->orWhere('nasipaddress', 'like', "%{$search}%")
                                ->orWhere('nasportid', 'like', "%{$search}%")
                                ->orWhere('nasporttype', 'like', "%{$search}%")
                                ->orWhere('acctstarttime', 'like', "%{$search}%")
                                ->orWhere('acctupdatetime', 'like', "%{$search}%")
                                ->orWhere('acctstoptime', 'like', "%{$search}%")
                                ->orWhere('acctinterval', 'like', "%{$search}%")
                                ->orWhere('acctsessiontime', 'like', "%{$search}%")
                                ->orWhere('acctauthentic', 'like', "%{$search}%")
                                ->orWhere('connectinfo_start', 'like', "%{$search}%")
                                ->orWhere('connectinfo_stop', 'like', "%{$search}%")
                                ->orWhere('acctinputoctets', 'like', "%{$search}%")
                                ->orWhere('acctoutputoctets', 'like', "%{$search}%")
                                ->orWhere('calledstationid', 'like', "%{$search}%")
                                ->orWhere('calingstationid', 'like', "%{$search}%")
                                ->orWhere('acctterminatecause', 'like', "%{$search}%")
                                ->orWhere('servicetype', 'like', "%{$search}%")
                                ->orWhere('framedprotocol', 'like', "%{$search}%")
                                ->orWhere('framedipaddress', 'like', "%{$search}%")
                                ->count();
            }		
        $data = array();
        
        if($posts){
            foreach($posts as $r){
                $nestedData['radacctid'] = $r->radacctid;
                $nestedData['acctsessionid'] = $r->acctsessionid;
                $nestedData['acctuniqueid'] = $r->acctuniqueid;
                $nestedData['username'] = $r->username;
                $nestedData['realm'] = $r->realm;
                $nestedData['nasipaddress'] = $r->nasipaddress;
                $nestedData['nasportid'] = $r->nasportid;
                $nestedData['nasporttype'] = $r->nasporttype;
                $nestedData['acctstarttime'] = $r->acctstarttime;
                $nestedData['acctupdatetime'] = $r->acctupdatetime;
                $nestedData['acctstoptime'] = $r->acctstoptime;
                $nestedData['acctinterval'] = $r->acctinterval;
                $nestedData['acctsessiontime'] = $r->acctsessiontime;
                $nestedData['acctauthentic'] = $r->acctauthentic;
                $nestedData['connectinfo_start'] = $r->connectinfo_start;
                $nestedData['connectinfo_stop'] = $r->connectinfo_stop;
                $nestedData['acctinputoctets'] = $r->acctinputoctets;
                $nestedData['acctoutputoctets'] = $r->acctoutputoctets;
                $nestedData['calledstationid'] = $r->calledstationid;
                $nestedData['calingstationid'] = $r->calingstationid;
                $nestedData['acctterminatecause'] = $r->acctterminatecause;
                $nestedData['servicetype'] = $r->servicetype;
                $nestedData['framedprotocol'] = $r->framedprotocol;
                $nestedData['framedipaddress'] = $r->framedipaddress;
                $nestedData['action'] = "
                    <a href='".route('radacct.edit', ['id' => $r->radacctid])."' class='btn btn-warning btn-xs'>Edit</a>
                    <a href='".route('radacct.delete', ['id' => $r->radacctid])."' class='btn btn-danger btn-xs'>Delete</a>
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
        return view('radacct.create');
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
            'radacctid' => 'required',
            'acctsessionid' => 'required',
            'acctuniqueid' => 'required',
            'username' => 'required',
            'realm' => 'required',
            'nasipaddress' => 'required',
            'nasportid' => 'required',
            'nasporttype' => 'required',
            'acctstarttime' => 'required',
            'acctupdatetime' => 'required',
            'acctstoptime' => 'required',
            'acctinterval' => 'required',
            'acctsessiontime' => 'required',
            'acctauthentic' => 'required',
            'connectinfo_start' => 'required',
            'connectinfo_stop' => 'required',
            'acctinputoctets' => 'required',
            'acctoutputoctets' => 'required',
            'calledstationid' => 'required',
            'calingstationid' => 'required',
            'acctterminatecause' => 'required',
            'servicetype' => 'required',
            'framedprotocol' => 'required',
            'framedipaddress' => 'required',
        ]);

        // Insert into database
        // $radData = new RadAcctProvider;
        // $id = $request->input('id');
        // $username = $request->input('username');
        // $pass = $request->input('pass');
        // $reply = $request->input('reply');
        // $authdate = $request->input('authdate');
        // $radData = DB::insert('INSERT INTO radacct (id, username, pass, reply, authdate) VALUES (?,?,?,?,?)', 
        //     [$id,$username,$pass,$reply,$authdate]);
        return redirect('../public/radacct')->with('success', 'Data Created');
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
        $rad = RadAcctProvider::find($id);
        return view('radacct.edit')->with('radData', $rad);
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
            'radacctid' => 'required',
            'acctsessionid' => 'required',
            'acctuniqueid' => 'required',
            'username' => 'required',
            'realm' => 'required',
            'nasipaddress' => 'required',
            'nasportid' => 'required',
            'nasporttype' => 'required',
            'acctstarttime' => 'required',
            'acctupdatetime' => 'required',
            'acctstoptime' => 'required',
            'acctinterval' => 'required',
            'acctsessiontime' => 'required',
            'acctauthentic' => 'required',
            'connectinfo_start' => 'required',
            'connectinfo_stop' => 'required',
            'acctinputoctets' => 'required',
            'acctoutputoctets' => 'required',
            'calledstationid' => 'required',
            'calingstationid' => 'required',
            'acctterminatecause' => 'required',
            'servicetype' => 'required',
            'framedprotocol' => 'required',
            'framedipaddress' => 'required',
        ]);

        // Insert into database
        // $radData = RadAcctProvider::find($id);
        // $id = $request->input('id');
        // $username = $request->input('username');
        // $pass = $request->input('pass');
        // $reply = $request->input('reply');
        // $authdate = $request->input('authdate');
        // $radData = DB::update('UPDATE radacct set username = ? where id = ?', [$username,$id]);
        // $radData = DB::update('UPDATE radacct set pass = ? where id = ?', [$pass,$id]);
        // $radData = DB::update('UPDATE radacct set reply = ? where id = ?', [$reply,$id]);
        // $radData = DB::update('UPDATE radacct set authdate = ? where id = ?', [$authdate,$id]);
        return redirect('../public/radacct')->with('success', 'Data Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = RadAcctProvider::find($id);
        $deleted->delete();
        return redirect('../public/radacct')->with('success', 'Data Removed');
    }
}
