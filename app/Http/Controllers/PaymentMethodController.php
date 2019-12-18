<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PaymentMethod;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payment_method = PaymentMethod::all();
        return view('admin.payment_methods.index', ['payment_method' => $payment_method]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.payment_methods.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $this->validate($request, ['method_name' => 'required|unique:payment_methods',
                                   'created_by' => 'required']);
        $data = $request->only('method_name', 'created_by');
        $payment_method = PaymentMethod::create($data);
        return redirect('/payment_methods')->with('message', 'payment method added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payment_method = PaymentMethod::find($id);
        return view('admin.payment_methods.show', ['payment_method' => $payment_method]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payment_method = PaymentMethod::find($id);
        return view('admin.payment_methods.edit', ['payment_method'=>$payment_method]);
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
        //$payment_method = PaymentMethod::find($id);
        $this->validate($request, ['method_name' => 'required|unique:payment_methods',
                                   'created_by' => 'required']);
        $data = $request->only('method_name', 'created_by');
        
        $payment_method->update($data);
        return redirect('/payment_methods')->with('message', 'data updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payment_method = PaymentMethod::find($id);
        try{
            $payment_method->delete();
        }
        catch (\Illuminate\Database\QueryException $e){
            $request->session()->flash('danger', 'Unable to delete this payment method');
            return redirect('/payment_methods')->with('message', 'This payment method cannot be deleted');
        }
        return redirect('/payment_methods')->with('message', 'Method deleted');
    }

    public function GetDataForDataTable(Request $request) {
        $payment_methods = new PaymentMethod();
        return $payment_methods->GetListForDataTable(
            $request->input('length'),
            $request->input('start'),
            $request->input('search')['value'],
            $request->input('status')
        );
    }
}
