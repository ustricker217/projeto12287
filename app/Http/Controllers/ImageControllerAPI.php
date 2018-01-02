<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestChangePermission;
use Illuminate\Http\Request;
use App\Image;
use App\Http\Resources\Image as ImageResources;
use Illuminate\Support\Facades\DB;


class ImageControllerAPI extends Controller
{
    public function index()
    {
        //
        return ImageResources::collection(Image::paginate(5));
    }

    public function changeStatus(Request $request, $id)
    {
        $image = Image::findOrFail($id);

        $status = $request->input("estado");

        if ($status) {
            $image->active = 0;

        } else {
            $image->active = 1;
        }
        $image->save();

        return response()->json(null, 200);
    }

    public function destroy($id)
    {
        $image = Image::findOrFail($id);
        $image->delete();
        return response()->json(null, 204);
    }
}