<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotePostRequest;
use App\Http\Resources\NoteResource;
use App\Models\Note;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    /**
     * メモ一覧取得
     * @return AnonymousResourceCollection
     */
    public function fetch(): AnonymousResourceCollection
    {
        $id = Auth::id();
        if (!$id) {
            throw new Exception('ログインしていません');
        }

        try{
            $notes = Note::where('user_id', $id)->get();
        } catch (Exception $e) {
            throw $e;
        }

        return NoteResource::collection($notes);
    }

    /**
     * メモ作成
     * @param NotePostRequest $request
     * @return NoteResource
     */
    public function create(NotePostRequest $request): JsonResponse{
        try {
            $note = new Note();
            $note->user_id = Auth::id();
            $note->body = $request->body;
            $note->save();
        } catch (Exception $e) {
            throw $e;
        }

        return response()->json([
            'message' => 'メモを作成しました',
            'note' => new NoteResource($note)
        ], 201);
    }
}
