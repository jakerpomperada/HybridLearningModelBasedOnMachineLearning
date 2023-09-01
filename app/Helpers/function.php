<?php

    use Illuminate\Http\JsonResponse;
    use Illuminate\Http\RedirectResponse;
    use Illuminate\Support\Facades\Redirect;
    use Illuminate\Support\Str;
    use Illuminate\Validation\Validator;

    function validateErrorResponse(Validator $validator): JsonResponse
    {
        return response()->json([
            'errmsg' => $validator->getMessageBag()->all()[0]
        ], 500);
    }

    function successResponse(array $data): JsonResponse
    {

        return response()->json([
            'success' => true,
            'data'    => $data
        ]);
    }

    function redirectWithErrors(Validator $validator): RedirectResponse
    {
        return Redirect::back()->withErrors($validator->getMessageBag()->all()[0]);
    }

    function redirectWithInput(Validator $validator): RedirectResponse
    {
        return Redirect::back()->withInput()->withErrors($validator->getMessageBag()->all()[0]);
    }


    function redirectWithAlert(string $loc, array $alert): RedirectResponse
    {
        return Redirect::to($loc)->with($alert);
    }

    function uuid(): string
    {
        return Str::uuid();
    }
