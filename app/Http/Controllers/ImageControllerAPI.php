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

    public function store(Request $request)
    {
        $image = new Image();
        $image->face = 'tile';
        $image->active = 0;

        $ext = $request->file->guessClientExtension();
        $filename = str_random(5);
        $path = $filename . '.' . "{$ext}";

        $image->path = $path;
        $image->save();

        $request->file('file')->move(public_path('/img'), $filename);

        return response()->json(null, 200);
    }
}