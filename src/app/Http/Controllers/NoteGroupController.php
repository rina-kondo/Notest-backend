<?php

namespace App\Http\Controllers;

// use App\Http\Requests\NoteGroupPostRequest;
use App\Http\Resources\NoteGroupResource;
use Illuminate\Http\Request;
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
     * @param $note_group_id
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

    /**
     * メモグループ作成
     * @return JsonResponse
     */
    public function create(): JsonResponse
    {
        try {
            $noteGroup = new NoteGroup();
            $noteGroup->user_id = Auth::id();
            $noteGroup->save();
        } catch (Exception $e) {
            throw $e;
        }

        return response()->json([
            'message' => 'メモグループを作成しました',
            'note_group' => new NoteGroupResource($noteGroup)
        ], 201);
    }

    /**
     * メモグループ削除
     * @param Request $request
     * @return JsonResponse
     */
    public function delete(Request $request): JsonResponse
    {
        $ids = $request->input('ids');

        if (!$ids || !is_array($ids)) {
            return response()->json(['error' => 'Invalid input'], 400);
        }

        try {
            NoteGroup::whereIn('id', $ids)->delete();
        } catch (Exception $e) {
            throw $e;
        }
        return response()->json([
            'message' => 'メモグループを削除しました',
        ], 200);
    }
}
