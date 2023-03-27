<?php

namespace App\Http\Controllers;

use App\BusinessQRCode;
use App\Helpers\QRCodeHelper;
use App\Http\Requests\CreateBusinessQRCodeRequest;
use Illuminate\Support\Str;

class BusinessQRCodeController extends Controller
{
    public function store(CreateBusinessQRCodeRequest $request, QRCodeHelper $qrCodeHelper)
    {
        $validatedData = $request->validated();

        $dataqr = config('app.url') . "/" . $validatedData['owner_name'];
        $fileName = Str::random() . ".png";

        $qrCodeHelper->saveQRCodeFile($fileName, $dataqr);

        BusinessQRCode::create(array_merge(
            $validatedData,
            [ 'qrcode_path' => $fileName ],
        ));

        return response('', 201);
    }
}
