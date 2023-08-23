<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotePostRequest;
use App\Http\Resources\SaveSettingPutRequest;
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
            $note->is_saved = $request->is_saved;
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

    /**
     * メモ更新
     * @param NotePostRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(NotePostRequest $request, $id): JsonResponse{
        try {
            $note = Note::find($id);
            $note->body = $request->body;
            $note->save();
        } catch (Exception $e) {
            throw $e;
        }

        return response()->json([
            'message' => 'メモを更新しました',
            'note' => new NoteResource($note)
        ], 200);
    }

    /**
     * メモの保存設定変更
     * @param int $id
     * @return JsonResponse
     */
    public function toggleSaveSetting($id): JsonResponse{
        try {
            $note = Note::find($id);
            $note->is_saved = !$note->is_saved;
            $note->save();
        } catch (Exception $e) {
            throw $e;
        }

        return response()->json([
            'message' => 'メモの保存設定を変更しました',
            'note' => new NoteResource($note)
        ], 200);
    }

    /**
    * メモ削除
    * @param int $id
    * @return JsonResponse
    */
    public function delete($id): JsonResponse{
        try {
            $note = Note::find($id);
            $note->delete();
        } catch (Exception $e) {
            throw $e;
        }

        return response()->json([
            'message' => 'メモを削除しました',
            'note' => new NoteResource($note)
        ], 200);
    }

    /**
     * メモの検索
     * @param string $keyword
     * @return AnonymousResourceCollection
     */
    public function search($keyword): AnonymousResourceCollection{
        $id = Auth::id();
        try {
            if (empty($keyword)) {
                $notes = Note::where('user_id', $id)->get();
            } else {
                $notes = Note::where('user_id', $id)->where('body', 'like', "%{$keyword}%")->get();
            }
        } catch (Exception $e) {
            throw $e;
        }/*  */

        return NoteResource::collection($notes);
    }
}
