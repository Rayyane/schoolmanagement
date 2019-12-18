<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FeesType;

class FeesTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fees_type = FeesType::all();
        return view('admin.fees_types.index', ['fees_type' => $fees_type]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.fees_types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['fees_type_name' => 'required',
                                   'user_id' => 'required'
                                   ]);
        $data = $request->only('fees_type_name', 'user_id');
        //dd($data);
        $fees_type = FeesType::create($data);
        return redirect('/fees_types')->with('message', 'Fees Type added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fees_type = FeesType::find($id);
        return view('admin.fees_types.show', ['fees_type' => $fees_type]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fees_type = FeesType::find($id);
        return view('admin.fees_types.edit', ['fees_type' => $fees_type]);
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
        $fees_type = FeesType::find($id);
        $this->validate($request, ['fees_type_name' => 'required',
                                   'user_id' => 'required'
                                   ]);
        $data = $request->only('fees_type_name', 'user_id');
        //dd($data);
        $fees_type->update($data);
        return redirect('/fees_types')->with('message', 'Data Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fees_type = FeesType::find($id);
        try{
            $fees_type->delete();
        }
        catch (\Illuminate\Database\QueryException $e){
            $request->session()->flash('danger', 'Unable to delete this DATA');
            return redirect('/fees_types')->with('message', 'This data cannot be deleted');
        }
        return redirect('/fees_types')->with('message', 'Data Deleted!');
    }

    public function GetDataForDataTable(Request $request) {
        $fees_type = new FeesType();
        return $fees_type->GetListForDataTable(
            $request->input('length'),
            $request->input('start'),
            $request->input('search')['value'],
            $request->input('status')
        );
    }
}
