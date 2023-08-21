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
}
