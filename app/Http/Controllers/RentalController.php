<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rental;
use App\Models\User;
use App\Http\Resources\RentalResource;
use App\Http\Requests\RentalRequest;
class RentalController extends Controller
{
    public function getRental(){
        $house=Rental::latest()->get();
        $response=RentalResource::collection($house);
        return response($response,200);
    }

    public function addRental(RentalRequest $request){
        $house = Rental::create([
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'price' => $request->price,
            'photo' => $request->photo,
            'user_id' => $request->user_id
            ]);
    
            $response=[
                'message'=>'Rent House Created',
                'house'=>$house,
            ];
            return response($response,200);
    }

    public function getRecomendation(Request $request, $id){
        $user = User::find($id);
        $recommendedHouses = Rental::where('location', $user->address)->get();
        $response=RentalResource::collection($recommendedHouses);
        return response($response, 200);

    }

    public function updateRental(RentalRequest $request, $id){
        $house = Rental::find($id);
        $house->title = $request->title;
        $house->description = $request->description;
        $house->location = $request->location;
        $house->price = $request->price;
        $house->user_id = $request->user_id;
        $house->save();
        if($house){
            $response =[
                'message'=> 'Rent House Updated',
                'house' => $house
            ];
        }else{
            $response =[
                'message'=> 'Error on Updateding',
            ];
        }
        
        return response($response, 200);

    }

    public function deleteHouse($id){
        $house = Rental::find($id);
        if ($house) {
            $house->delete();
            $response = [
                'message' => 'House deleted successfully!'
            ];
            return response($response, 200);
        } else {
            $response = [
                'message' => 'House not found!'
            ];
            return response($response, 404);
        }
    }

    public function getImage( $filename){
        $path = public_path('images/' . $filename);

        if (file_exists($path)) {
            return response()->file($path);
        }
    
        abort(404);
    }

    public function uploadImage(Request $request){
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = rand().'.'.$file->getClientOriginalName();
            $file->move(public_path('images'), $fileName);

            return response()->json($fileName, 200);
        }

        return response()->json(['message' => 'Invalid file upload'], 400);


    }
}
