<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\ProductResource;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


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

    public function show($id)
    {
        try {
            $product = Product::findOrFail($id);

            return $this->sendResponse(new ProductResource($product)    , 'Product Retrieved Successfully.');
        } catch (ModelNotFoundException $e) {
            return $this->sendError('Product not found.', [], 404);
        }
    }
    public function update(Request $request, $id)
    {
        // Check if the user has permission to update a product
        if (!Auth::user()->hasPermissionTo('products.update')) {
            return $this->sendError('Unauthorized. You do not have permission to update a product.', [], 403);
        }

        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            // Add any other validation rules for your fields here
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $product = Product::find($id);

        if (!$product) {
            return $this->sendError('Product not found.', [], 404);
        }

        // Update only if 'name' exists in the input
        if (isset($input['name'])) {
            $product->name = $input['name'];
        }

        // Update only if 'detail' exists in the input
        if (isset($input['detail'])) {
            $product->detail = $input['detail'];
        }

        $product->save();

        return $this->sendResponse(new ProductResource($product), 'Product Updated Successfully.');
    }

    public function destroy(Request $request, $id)
    {

        // Check if the user has permission to update a product
        if (!Auth::user()->hasPermissionTo('products.destroy')) {
            return $this->sendError('Unauthorized. You do not have permission to update a product.', [], 403);
        }
        $product = Product::find($id);

        $product->delete();

        return new ProductResource($product);
    }

}
