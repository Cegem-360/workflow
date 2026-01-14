<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\ExecuteWorkflow;
use App\Models\Workflow;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function trigger(Request $request, string $token): JsonResponse
    {
        $workflow = Workflow::activeWebhook($token)->first();

        if (! $workflow) {
            return response()->json([
                'success' => false,
                'error' => 'Webhook not found or not active',
            ], 404);
        }

        ExecuteWorkflow::dispatch($workflow, $request->all());

        return response()->json([
            'success' => true,
            'message' => 'Workflow triggered successfully',
            'workflow_id' => $workflow->id,
        ], 202);
    }
}
