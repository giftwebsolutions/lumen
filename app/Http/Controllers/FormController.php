<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FormController extends Controller
{
    
    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function calculate(Request $request): JsonResponse
    {
        $this->validate($request, [
            'a' => ['required', 'numeric'],
            'b' => ['required', 'numeric'],
        ]);
        
        try {
    
            $a = (int) $request->input('a');    
            $b = (int) $request->input('b');
    
            return response()->json([
                'a' => $a,
                'b' => $b,
                'result' => $a / $b
            ]);
            
        } catch (\Throwable $e) {
            
            return response()->json([
                'error' => [
                    'description' => $e->getMessage()
                ]
            ], 500);
            
        }
    }
    
}
