<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\ProductResource;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;



class ProductController extends BaseController
{
    public function index()
    {
        $products = Product::all();


        return $this->sendResponse(ProductResource::collection($products), 'Products Retrieved Successfully.');
    }


    public function store(ProductRequest $request)
    {
        $user_id= Auth::user()->id;
        echo $user_id;
        if (!Auth::user()->hasPermissionTo('products.store')) {
            return $this->sendError('Unauthorized. You do not have permission to create a product.', [], 403);
        }

        $input = $request->all();

        $input['user_id'] = Auth::user()->id;

        $product = Product::create($input);

        return $this->sendResponse(new ProductResource($product), 'Product Created Successfully.');
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $productResource = new ProductResource($product);

        return response()->json(['data' => $productResource, 'message' => 'Product retrieved successfully']);
    }


    public function update(Request $request, $slug)
    {
        if (!Auth::user()->hasPermissionTo('products.update')) {
            return $this->sendError('Unauthorized. You do not have permission to update a product.', [], 403);
        }

        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $product = Product::where('slug', $slug)->first();
        if (!$product) {
            return $this->sendError('Product not found.', [], 404);
        }
        if (isset($input['name'])) {
            $product->name = $input['name'];
        }
        if (isset($input['detail'])) {
            $product->detail = $input['detail'];
        }

        $product->save();

        return $this->sendResponse(new ProductResource($product), 'Product Updated Successfully.');
    }
    public function destroy(Request $request, $slug)
    {
        if (!Auth::user()->hasPermissionTo('products.destroy')) {
            return $this->sendError('Unauthorized. You do not have permission to delete a product.', [], 403);
        }

        $product = Product::where('slug', $slug)->first();

        if (!$product) {
            return $this->sendError('Product not found.', [], 404);
        }
        $product->delete();

        return new ProductResource($product);
    }
}
