<?php

namespace App\Http\Controllers;

use App\Category;
use App\Supplier;
use Illuminate\Http\Request;
use Validator;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier = Supplier::all();

        return view('admin.suppliers.index', ['supplier' => $supplier]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('category_name', 'id');

        return view('admin.suppliers.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category_id = $request->category_id;
        $supplier_name = $request->supplier_name;

        $data = ['category_id' => $category_id, 'supplier_name' => $supplier_name];

        $validation = Validator::make([
            'category_id' => $category_id, 'supplier_name' => $supplier_name,
        ], [], []);

        $validation->after(function ($validation) use ($category_id, $supplier_name) {
            $checkCombination = Supplier::where('category_id', $category_id)
                                        ->where('supplier_name', $supplier_name)
                                        ->get();

            if (count($checkCombination) > 0) {
                $validation->errors()
                ->add('supplier_name', 'already exists');
            }
        });

        if ($validation->fails()) {
            foreach ($validation->errors()->all() as $error) {
                //dd($error);
                $message = $error;
            }
        } else {
            $supplier = Supplier::create($data);

            return redirect('/suppliers')->with('message', 'supplier added');
        }

        return redirect('/suppliers')->with('message', 'supplier could not be added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplier = Supplier::find($id);

        return view('admin.suppliers.show', ['supplier' => $supplier]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier = Supplier::find($id);
        $categories = Category::pluck('category_name', 'id');

        return view('admin.suppliers.edit', ['categories' => $categories, 'supplier' => $supplier]);
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
        $supplier = Supplier::find($id);
        $category_id = $request->category_id;
        $supplier_name = $request->supplier_name;

        $data = ['category_id' => $category_id, 'supplier_name' => $supplier_name];

        $validation = Validator::make([
            'category_id' => $category_id, 'supplier_name' => $supplier_name,
        ], [], []);

        $validation->after(function ($validation) use ($category_id, $supplier_name) {
            $checkCombination = Supplier::where('category_id', $category_id)
                                        ->where('supplier_name', $supplier_name)
                                        ->get();

            if (count($checkCombination) > 0) {
                $validation->errors()
                ->add('supplier_name', 'already exists');
            }
        });

        if ($validation->fails()) {
            foreach ($validation->errors()->all() as $error) {
                //dd($error);
                $message = $error;
            }
        } else {
            $supplier->update($data);

            return redirect('/suppliers')->with('message', 'supplier updated');
        }

        return redirect('/suppliers')->with('message', 'supplier could not be updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        try {
            $supplier->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            $request->session()->flash('danger', 'Unable to delete this data');

            return redirect('/suppliers')->with('message', 'This supplier cannot be deleted');
        }

        return redirect('/suppliers')->with('message', 'supplier deteted!');
    }

    public function GetDataForDataTable(Request $request)
    {
        $supplier = new Supplier();

        return $supplier->GetListForDataTable(
            $request->input('length'),
            $request->input('start'),
            $request->input('search')['value'],
            $request->input('status')
        );
    }
}
