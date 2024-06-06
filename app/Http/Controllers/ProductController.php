<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Yajra\DataTables\Facades\Datatables;
use Illuminate\Http\Request;

class ProductController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    if ($request->ajax()) {
      $data = Product::latest()->get();
      return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
          $actionBtn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="editRecord btn btn-primary btn-sm">Edit</a> 
              <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="deleteRecord btn btn-danger btn-sm">Delete</a>';
          return $actionBtn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    return view('content.product.index');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('content.product.create');
  }

  /**

   * Store a newly created resource in storage.

   *

   * @param  \Illuminate\Http\Request  $request

   * @return \Illuminate\Http\Response

   */

  public function store(Request $request)
  {
    Product::updateOrCreate(
      [
        'id' => $request->id
      ],
      [
        'name' => $request->name,
        'code' => $request->code,
        'description' => $request->description,
        'brand' => $request->brand,
        'type' => $request->type,
        'category' => $request->category,
        'price' => $request->price,
        'image' => $request->image,
        'video' => $request->video,
        'stock' => $request->stock
      ]
    );
    return redirect()->back();
  }

  /**
   * Display the specified resource.
   */
  public function show(Product $product)
  {
    //
  }

  /**
   * Show the form for editingthe specified resource.
   *
   * @return \Illuminate\Http\Response
   */

  public function edit($id)
  {
    $product = Product::find($id);
    return response()->json($product);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Product $product)
  {
    $this->validate($request, [
      'name' => 'required',
      'status' => 'required',
      'subscription_deadline' => 'required',
    ]);

    $product->update([
      'name' => $request->name,
      'status' => $request->status,
      'subscription_deadline' => $request->subscription_deadline,
    ]);

    return redirect()->back();
  }

  /**
   * Remove the specified resource from storage.
   *
   * @return \Illuminate\Http\Response
   */

  public function destroy($id)
  {
    Product::find($id)->delete();
    return response()->json(['success' => 'Data deleted successfully.']);
  }
}
