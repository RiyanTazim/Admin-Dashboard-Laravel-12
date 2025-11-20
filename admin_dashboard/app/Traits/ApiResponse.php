<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

trait ApiResponse
{
    /**
     * Return a success JSON response.
     */
    public function successResponse($data = null, string $message = 'Success', int $status = 200): JsonResponse
    {
        return response()->json([
            'status'  => 'success',
            'message' => $message,
            'data'    => $data,
        ], $status);
    }

    /**
     * Return an error JSON response.
     */
    public function errorResponse(string $message = 'Error', int $status = 400, $errors = null): JsonResponse
    {
        $response = [
            'status'  => 'error',
            'message' => $message,
        ];

        if ($errors) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $status);
    }

    /**
     * Upload a file or image.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $folder
     * @param string $name
     * @return string|null
     */
    public function fileUpload($file, string $folder, string $name): ?string
    {
        if (!$file || !$file->isValid()) {
            return null;
        }

        // Generate filename
        $imageName = Str::slug($name) . '.' . $file->getClientOriginalExtension();

        $uploadPath = public_path('uploads/' . $folder);

        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        // Move file
        $file->move($uploadPath, $imageName);

        return 'uploads/' . $folder . '/' . $imageName;
    }

    /**
     * Delete a file or image.
     *
     * @param string|null $path
     * @return void
     */
    public function fileDelete(string $path): void
    {
        if (!$path) {
            return;
        }

        $fullPath = public_path($path);

        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
    }
}
