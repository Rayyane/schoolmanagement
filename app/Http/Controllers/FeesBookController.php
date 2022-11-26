<?php

namespace App\Http\Controllers;

use App\Branch;
use App\CollectedFees;
use App\FeesBook;
use App\Prefix;
use App\Teacher;
use Illuminate\Http\Request;
use Validator;

class FeesBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fees_book = FeesBook::all();

        return view('admin.fees_books.index', ['fees_book' => $fees_book]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = Branch::pluck('name', 'id');
        $teachers = Teacher::pluck('teacher_name', 'id');
        $prefixes = Prefix::pluck('prefix', 'id');

        return view('admin.fees_books.create', ['branches' => $branches, 'teachers' => $teachers,
            'prefixes' => $prefixes, ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //leaf start and end configuration
        $prefix_id = $request->input('prefix_id');
        /*$leaf_end_number = FeesBook::where('prefix', $prefix)->get()->last();
        $leaf_end_num = $leaf_end_number['leaf_end_number'];
        preg_match("/([a-zA-Z]+)(\\d+)/", $leaf_end_num, $matches);
        if (count($matches) == 0) {
            $leaf_start_num = 1;
            //dd($leaf_start_num);
        }
        else {
            $leaf_start_num = ((int) $matches[2]) + 1;
            //dd($leaf_start_num);
        }*/

        $total_leaf = $request->input('total_leaf');
        $leaf_start_num = $request->input('leaf_start_number');
        $leaf_end_num = $leaf_start_num + $total_leaf - 1;

        $str_length = 6;
        $leaf_start_number = substr("0000000000{$leaf_start_num}", -$str_length);
        $leaf_end_number = substr("0000000000{$leaf_end_num}", -$str_length);
        //$prefix = $request->input('prefix');
        //$leaf_start = $leaf_start_number;
        //$leaf_end = $leaf_end_number;
        //

        $branch_id = $request->input('branch_id');
        $teacher_id = $request->input('teacher_id');

        //$leaf_start_number = $request->input('leaf_start_number');
        $creator_user_id = $request->input('creator_user_id');
        //$prefix = $request->input('prefix');

        /*$leaf_end_number = (($leaf_start_number + $total_leaf) - 1);
        $leaf_end_number = strval($leaf_end_number);*/

        $data = ['branch_id' => $branch_id, 'teacher_id' => $teacher_id,
            'total_leaf' => $total_leaf, 'leaf_start_number' => $leaf_start_number,
            'leaf_end_number' => $leaf_end_number,  'creator_user_id' => $creator_user_id,
            'prefix_id' => $prefix_id,
        ];

        $validation = Validator::make(['branch_id' => $branch_id,
            'teacher_id' => $teacher_id,
            'total_leaf' => $total_leaf,
            'leaf_start_number' => $leaf_start_number,
            'leaf_end_number' => $leaf_end_number,
            'creator_user_id' => $creator_user_id,
            'prefix_id' => $prefix_id,
        ], [], []);
        /*$checkCombination = FeesBook::where('leaf_end_number', '>=', $leaf_start_number)
                                    ->where('leaf_start_number', '<=', $leaf_end_number)
                                    ->where('prefix_id', $prefix_id)
                                    ->get();*/

        //dd(count($checkCombination));
        //dd($validation->fails());
        $validation->after(function ($validation) use ($leaf_start_number, $leaf_end_number, $prefix_id) {
            $checkCombination = FeesBook::where('leaf_end_number', '>=', $leaf_start_number)
                                    ->where('leaf_start_number', '<=', $leaf_end_number)
                                    ->where('prefix_id', $prefix_id)
                                    ->get();
            //dd(count($checkCombination));
            if (count($checkCombination) > 0) {
                $validation->errors()->add('prefix_id', 'Student result already exists');
            }
        });
        //dd($validation->fails());
        if ($validation->fails()) {
            foreach ($validation->errors()->all() as $error) {
                //dd($error);
                $message = $error;
            }
        } else {
            $fees_book = FeesBook::create($data);

            return redirect('/fees_books')->with('message', 'fees book added');
        }

        //$user = request()->user()->name;

        //dd($data);
        return redirect('/fees_books')->with('message', 'fees book could not be added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fees_book = FeesBook::find($id);

        return view('admin.fees_books.show', ['fees_book' => $fees_book]);
    }

    /**
     * check valid leaf number with prefix in real time.
     * Author :Abdullah (Systech Digital Limited)
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function checkPrefixLeaf(Request $request)
    {
        $leaf_number = intval($request->input('fees_book_leaf_number'));
        $prefix_id = $request->input('leaf_prefix');
        $fees_books = FeesBook::where([['prefix_id', $prefix_id], ['leaf_start_number', '<=', $leaf_number], ['leaf_end_number', '>=', $leaf_number]])->get();

        $valid = $fees_books->count();
        if ($valid < 1) {
            return 'false';
        } else {
            $unique = CollectedFees::where([['prefix_id', $prefix_id], ['fees_book_leaf_number', $leaf_number]])->get();
            if ($unique->count() > 0) {
                return 'false';
            } else {
                return 'true';
            }
        }

        return 'true';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $branches = Branch::pluck('name', 'id');
        $teachers = Teacher::pluck('teacher_name', 'id');
        $prefixes = Prefix::pluck('prefix', 'id');
        $fees_book = FeesBook::find($id);

        return view('admin.fees_books.edit', ['fees_book' => $fees_book, 'branches' => $branches, 'teachers' => $teachers, 'prefixes' => $prefixes]);
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
        $fees_book = FeesBook::find($id);

        $branch_id = $request->input('branch_id');
        $teacher_id = $request->input('teacher_id');
        $prefix_id = $request->input('prefix_id');
        $total_leaf = $request->input('total_leaf');
        $leaf_start_num = $request->input('leaf_start_number');
        $leaf_end_num = $leaf_start_num + $total_leaf - 1;

        $str_length = 6;
        $leaf_start_number = substr("0000000000{$leaf_start_num}", -$str_length);
        $leaf_end_number = substr("0000000000{$leaf_end_num}", -$str_length);

        $creator_user_id = $request->input('creator_user_id');

        $data = ['branch_id' => $branch_id, 'teacher_id' => $teacher_id,
            'total_leaf' => $total_leaf, 'leaf_start_number' => $leaf_start_number,
            'leaf_end_number' => $leaf_end_number,  'creator_user_id' => $creator_user_id,
            'prefix_id' => $prefix_id,
        ];
        $validation = Validator::make(['branch_id' => $branch_id,
            'teacher_id' => $teacher_id,
            'total_leaf' => $total_leaf,
            'leaf_start_number' => $leaf_start_number,
            'leaf_end_number' => $leaf_end_number,
            'creator_user_id' => $creator_user_id,
            'prefix_id' => $prefix_id,
        ], [], []);

        //dd($data);
        //$user = request()->user()->name;
        $validation->after(function ($validation) use ($leaf_start_number, $leaf_end_number, $prefix_id) {
            $checkCombination = FeesBook::where('leaf_end_number', '>=', $leaf_start_number)
                                    ->where('leaf_start_number', '<=', $leaf_end_number)
                                    ->where('prefix_id', $prefix_id)
                                    ->get();
            //dd(count($checkCombination));
            if (count($checkCombination) > 0) {
                $validation->errors()->add('prefix_id', 'Student result already exists');
            }
        });
        //dd($validation->fails());
        if ($validation->fails()) {
            foreach ($validation->errors()->all() as $error) {
                //dd($error);
                $message = $error;
            }
        } else {
            $fees_book->update($data);

            return redirect('/fees_books')->with('message', 'fees book updated');
        }

        //$user = request()->user()->name;

        //dd($data);
        return redirect('/fees_books')->with('message', 'fees book could not be updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fees_book = FeesBook::find($id);
        try {
            $fees_book->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            $request->session()->flash('danger', 'Unable to delete this data');

            return redirect('/fees_books')->with('message', 'Unable to delete this data');
        }

        return redirect('/fees_books')->with('message', 'data deleted');
    }

    public function GetDataForDataTable(Request $request)
    {
        $fees_book = new FeesBook();

        return $fees_book->GetListForDataTable(
            $request->input('length'),
            $request->input('start'),
            $request->input('search')['value'],
            $request->input('status')
        );
    }
}
