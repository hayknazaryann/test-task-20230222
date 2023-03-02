<?php

namespace App\Http\Controllers;

use App\Enums\Actions;
use App\Models\ActivityLog;
use App\Models\JsonData;
use App\Repositories\Interfaces\JsonDataRepositoryInterface;
use Illuminate\Http\Request;

class JsonDataController extends Controller
{

    private $jsonDataRepository;

    public function __construct(JsonDataRepositoryInterface $jsonDataRepository)
    {
        $this->jsonDataRepository = $jsonDataRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jsonData = $this->jsonDataRepository->allJsonData();
        $view = view('json.partials.table', compact('jsonData'))->render();
        if (\request()->ajax()) {
            return $view;
        }
        return view('json.index', compact('view'));
    }

    /**
     * Display a create form of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $action = Actions::CREATE;
        $view = view('json.form', compact('action'));
        if ($request->ajax()) {
            if ($request->loadContent) {
                return $view->render();
            }
            $token = \request()->header('USER-TOKEN');
            if (!$token) {
                return response()->json(['success' => false, 'message' => 'Token required'], 400);
            }

            if(!current_user()->tokenExpired($token)) {
                $this->jsonDataRepository->storeJsonData(['data' => json_decode($request->data, true), 'code' => generate_code()]);
                return response()->json(['success' => true, 'message' => 'Data successfully created'], 200);
            }

            return response()->json(['success' => false, 'message' => 'Token expired'], 401);
        }
        return view('json.index', compact('view'));
    }


    /**
     * Display a edit form of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $action = Actions::UPDATE;
        $view = view('json.form', compact('action'));
        if ($request->ajax()) {
            if ($request->loadContent) {
                return $view->render();
            }
            $token = \request()->header('USER-TOKEN');
            if (!$token) {
                return response()->json(['success' => false, 'message' => 'Token required'], 400);
            }
            if(!current_user()->tokenExpired($token)) {
                $this->jsonDataRepository->updateJsonData(['data' => json_decode($request->data, true)], $request->code);
                return response()->json(['success' => true, 'message' => 'Data successfully updated'], 200);
            }
        }
        return view('json.index', compact('view'));
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $code
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        $jsonData = JsonData::where(['code' => $code])->first();
        $view = view('json.show', compact('jsonData'));
        if (\request()->ajax()) {
            if (!$jsonData) {
                return response()->json(['success' => false, 'message' => 'Data not found'], 404);
            }
            return $view->render();
        }

        if (!$jsonData) {
            return redirect()->route('json.index')->with('error', 'Data not found');
        }
        return view('json.index', compact('view'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $code
     * @return \Illuminate\Http\Response
     */
    public function destroy($code)
    {
        $jsonData = JsonData::where(['code' => $code])->first();
        if (!$jsonData) {
            return response()->json(['success' => false, 'Data not found']);
        }
        $this->jsonDataRepository->destroyJsonData($jsonData->code);
        return redirect()->back()->with('success', 'Data deleted successfully');
    }

    public function logs()
    {
        $logs = current_user()->activityLog()->paginate(10);
        $view = view('logs.table', compact('logs'))->render();
        if (\request()->ajax()) {
            return $view;
        }
        return view('json.index', compact('view'));

    }
}
