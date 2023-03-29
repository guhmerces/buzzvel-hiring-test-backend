<?php

namespace App\Http\Controllers;

use App\BusinessQRCode;
use App\Helpers\QRCodeHelper;
use App\Http\Requests\CreateBusinessQRCodeRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BusinessQRCodeController extends Controller
{
    public function store(CreateBusinessQRCodeRequest $request, QRCodeHelper $qrCodeHelper)
    {
        $validatedData = $request->validated();

        $dataqr = config('app.qrcode_base_url') . "/" . $validatedData['owner_name'];
        $fileName = Str::random() . ".png";

        $qrCodeHelper->saveQRCodeFile($fileName, $dataqr);

        BusinessQRCode::create(array_merge(
            $validatedData,
            [ 'qrcode_path' => $fileName ],
        ));

        return response('', 201);
    }

    public function get(Request $request)
    {
        $businessQRCode = BusinessQRCode::where(['owner_name' => $request->owner_name])->get()->last();

        if($businessQRCode == null) {
            throw new ModelNotFoundException('Business owner name not found');
        }

        $content = array_merge(
            $businessQRCode->toArray(),
            [
                'qrcode_url' => asset('storage/' . $businessQRCode->qrcode_path)
            ]
        );

        return response($content)->header('Access-Control-Allow-Origin', '*');
    }
}
