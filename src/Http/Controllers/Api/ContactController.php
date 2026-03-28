<?php

namespace Juzaweb\Modules\Contact\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Illuminate\Http\JsonResponse;
use Juzaweb\Modules\Contact\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function store(ContactRequest $request): JsonResponse
    {
        $request->save();

        return response()->json([
            'message' => __('contact::translation.contact_created_successfully'),
            'status' => true,
        ]);
    }
}
