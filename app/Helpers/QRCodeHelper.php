<?php

namespace App\Helpers;

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use Illuminate\Support\Facades\Storage;

class QRCodeHelper
{
    private QRCode $qrCode;

    private QROptions $qrOptions;

    public function __construct(array $opts = [])
    {
        $this->qrOptions = new QROptions();
        $this->qrCode = new QRCode($this->qrOptions);
    }

    public function render(string $data): mixed
    {
        return $this->qrCode->render($data);
    }

    public function renderBase64(string $data): string
    {
        [$_, $data] = explode(',', $this->render($data));

        return $data;
    }

    public function saveQRCodeFile(string $file_name, string $data, string $file_extension = null ): bool
    {
        $qr_code_data = $this->renderBase64($data);

        return Storage::disk('public')->put($file_name, base64_decode($qr_code_data));
    }
}
