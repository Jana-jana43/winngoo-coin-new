<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use App\Models\Coin;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class CoinManagementController extends Controller
{

    public function index()
    {
        $coins = Coin::withCount('mining')->latest()->get();
        return view('admin.coinManagement.coinmanagement', compact('coins'));
    }

       public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:coins,name',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:5048',
            'image2' => 'required|image|mimes:jpg,jpeg,png|max:5048',
            'mining_period' => 'required|integer|min:1',
            'description' => 'required|string',
            'status' => 'nullable|in:active',
        ], [
            'name.unique' => 'Coin name must be unique.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('modal', 'showModalAdd'); // pass Add modal ID
        }


        // Handle status
        $status = $request->has('status') ? 'active' : 'inactive';

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');


            $destinationPath = public_path('assets/coin');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $filename = time() . '_' . Str::random(6) . '.' . $image->getClientOriginalExtension();

            $image->move($destinationPath, $filename);
            $imagePath = 'assets/coin/' . $filename;
        }

        $imagePath2 = null;
        if ($request->hasFile('image2')) {
            $image2 = $request->file('image2');


            $destinationPath2 = public_path('assets/coin');
            if (!file_exists($destinationPath2)) {
                mkdir($destinationPath2, 0755, true);
            }

            $filename = time() . '_' . Str::random(6) . '.' . $image2->getClientOriginalExtension();

            $image2->move($destinationPath2, $filename);
            $imagePath2 = 'assets/coin/' . $filename;
        }

        Coin::create([
            'name' => ucfirst($request->name),
            'image' => $imagePath ?? null,
            'image2' => $imagePath2 ?? null,
            'mining_period' => $request->mining_period,
            'description' => $request->description,
            'status' => $status,
        ]);

        return redirect()->back()->with('success', 'Coin created successfully!');
    }
    public function coinStatus(Request $request)
    {
        $coin = Coin::findOrFail($request->id);

        // If checkbox checked → active, else inactive
        $coin->status = $request->has('status') ? 'active' : 'inactive';

        $coin->save();

        return redirect()->back()->with('success', 'Status updated successfully.');
    }

    public function delete($id)
    {
        // Find the coin record
        $coin = Coin::findOrFail($id);

        // Delete coin image if it exists
        if (!empty($coin->image)) {
            $path = public_path($coin->image);

            if (File::exists($path)) {
                File::delete($path);
            }
        }

        // Delete coin record
        $coin->delete();

        return redirect()->back()->with('success', 'Coin deleted successfully');
    }


    public function update(Request $request, $id)
    {
        $coin = Coin::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'coin_name' => 'required|string|max:50|unique:coins,name,' . $id,
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
            'image2' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
            'mining_period' => 'required|integer|min:1|max:1000',
            'description' => 'required|string',
            'status' => 'nullable|string|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('modal', 'editModal' . $id); // pass full modal ID
        }


        $status = $request->status ?? 'inactive';

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if (!empty($coin->image) && File::exists(public_path($coin->image))) {
                File::delete(public_path($coin->image));
            }

            $file = $request->file('image');
            $filename = time() . '_' . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/coin'), $filename);
            $coin->image = 'assets/coin/' . $filename;
        }
        
        if ($request->hasFile('image2')) {
            // Delete old image if exists
            if (!empty($coin->image2) && File::exists(public_path($coin->image2))) {
                File::delete(public_path($coin->image2));
            }

            $file = $request->file('image2');
            $filename = time() . '_' . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/coin'), $filename);
            $coin->image2 = 'assets/coin/' . $filename;
        }

        // Update other fields
        $coin->name = ucfirst($request->coin_name);
        $coin->type = $request->type;
        $coin->mining_period = $request->mining_period;
        $coin->description = $request->description;
        $coin->status = $status;

        $coin->save();

        return redirect()->back()->with('success', 'Coin updated successfully.');
    }
}
