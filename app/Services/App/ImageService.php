<?php


namespace App\Services\App;


use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Illuminate\Support\Str;

class ImageService
{
    /**
     * @param string $base64
     * @return UploadedFile|null
     */
    public function makeFromBase64(string $base64): ?UploadedFile
    {
        try {
            $fileData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64));

            $tmpFilePath = sys_get_temp_dir() . '/' . Str::uuid()->toString();
            file_put_contents($tmpFilePath, $fileData);

            $tmpFile = new File($tmpFilePath);

            return new UploadedFile(
                $tmpFile->getPathname(),
                $tmpFile->getFilename(),
                $tmpFile->getMimeType(),
                0,
                true // Mark it as test, since the file isn't from real HTTP POST.
            );
        } catch (\Exception $exception) {
            return null;
        }

    }
}
