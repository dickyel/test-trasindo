<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\User;
use App\Models\Gallery;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();

        // Cek apakah user memiliki toko
        if ($user->rental) {
            $cars = $user->rental->cars;
            return view('pages.member.car', compact('cars'));
        }

        // Jika user tidak memiliki toko, kembalikan ke halaman dengan pesan
        return view('pages.member.car', ['noRental' => true]);
    }

    public function details(Request $request, $id)
    {
        $car = Car::with(['galleries','rental'])->findOrFail($id);
      
        
        return view('pages.member.detail-car',[
            'car' => $car,
       
        ]);
    }

    public function uploadGallery(Request $request)
    {
        $data = $request->all();

        $data['image'] = $request->file('image')->store('assets/rental', 'public');

        Gallery::create($data);

        return redirect()->route('car-form.detail', $request->car_id);
    }

    public function deleteGallery(Request $request, $id)
    {
        $item = Gallery::findOrFail($id);
        $item->delete();

        return redirect()->route('car-form.detail', $item->car_id);
    }

    public function create()
    {
        $users = User::all();

        return view('pages.member.create-car',[
            'users' => $users,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'merek' => 'required|string|max:255',
         
            'rental_id' => 'required', 
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
    
        $data = $request->all();
        $data['slug'] = Str::slug($request->merek);
    
        $data['rental_id'] = $request->rental_id;
    
        $car = Car::create($data);
    
        if ($request->hasFile('image')) {
            $gallery = [
                'car_id' => $car->id,
                'image' => $request->file('image')->store('assets/rental', 'public'),
            ];
    
            Gallery::create($gallery);
        }
    
        return redirect()->route('car-form.index');
    }
    

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $item = Car::findOrFail($id);

        $data['slug'] = Str::slug($request->name);

        $item->update($data);

        return redirect()->route('car-form.index');
    }

    public function destroy($id) 
    {
        //
        $item = Car::findOrFail($id);
        
        $item->delete();

        return redirect()->route('car-form.index', $item->car_id);

    }


}
