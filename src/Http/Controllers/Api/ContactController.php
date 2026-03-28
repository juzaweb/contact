<?php

namespace Juzaweb\Modules\Contact\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Illuminate\Http\JsonResponse;
use Juzaweb\Modules\Contact\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    /**
     * @OA\Post(
     *      path="/api/contact",
     *      tags={"Contact"},
     *      summary="Submit a contact form",
     *      description="Create a new contact request",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"name","email","subject","message"},
     *              @OA\Property(property="name", type="string", example="John Doe"),
     *              @OA\Property(property="email", type="string", format="email", example="john@example.com"),
     *              @OA\Property(property="phone", type="string", example="123456789"),
     *              @OA\Property(property="subject", type="string", example="Support Request"),
     *              @OA\Property(property="message", type="string", example="I need help with my account.")
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Contact created successfully."),
     *              @OA\Property(property="status", type="boolean", example=true)
     *          )
     *      )
     * )
     */
    public function store(ContactRequest $request): JsonResponse
    {
        $request->save();

        return response()->json([
            'message' => __('contact::translation.contact_created_successfully'),
            'status' => true,
        ]);
    }
}
