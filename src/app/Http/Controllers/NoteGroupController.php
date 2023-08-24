<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteGroupRequest;
use App\Http\Resources\NoteGroupResource;
use App\Models\NoteGroup;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class NoteGroupController extends Controller
{
    /**
     * メモグループ一覧取得
     * @return AnonymousResourceCollection
     */
    public function fetch(): AnonymousResourceCollection
    {
        $id = Auth::id();
        if (!$id) {
            throw new Exception('ログインしていません');
        }

        try {
            $noteGroups = NoteGroup::with('notes')->where('user_id', $id)->get();
        } catch (Exception $e) {
            throw $e;
        }

        return NoteGroupResource::collection($noteGroups);
    }

    /**
 * メモグループ単体取得
 * @param NoteGroupRequest $request
 * @return NoteGroupResource
 */
    public function show($note_group_id)
    {
        $id = Auth::id();
        if (!$id) {
            throw new Exception('ログインしていません');
        }

        $noteGroup = NoteGroup::with('notes')->where('user_id', $id)->where('id', $note_group_id)->firstOrFail();

        return new NoteGroupResource($noteGroup);
    }
}
