<?php

namespace App\Http\Controllers;

use App\Enums\Actions;
use App\Http\Requests\Json\StoreRequest;
use App\Http\Requests\Json\UpdateRequest;
use App\Models\JsonData;
use App\Repositories\Interfaces\JsonDataRepositoryInterface;
use Illuminate\Http\Request;
use Mockery\Exception;

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
        try {
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
                    $request->validate(['data' => 'required|json']);
                    $this->jsonDataRepository->storeJsonData(['data' => json_decode($request->data, true), 'uuid' => generate_uuid()]);
                    return response()->json(['success' => true, 'message' => 'Data successfully created'], 200);
                }
                return response()->json(['success' => false, 'message' => 'Token mismatch'], 401);
            }
            return view('json.index', compact('view'));
        } catch (Exception $exception) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong'], 400);
            }
            return redirect()->back()->with('error', 'Something went wrong');
        }

    }


    /**
     * Display a edit form of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
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
                    $request->validate(['uuid' => 'required|string','code' => 'required|string']);
                    $updated = $this->jsonDataRepository->updateJsonData($request->code, $request->uuid);
                    if ($updated) {
                        return response()->json(['success' => true, 'message' => 'Data successfully updated'], 200);
                    }
                    return response()->json(['success' => false, 'message' => 'Data not found'], 404);
                }
                return response()->json(['success' => false, 'message' => 'Token mismatch'], 401);
            }
            return view('json.index', compact('view'));
        } catch (Exception $exception) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong'], 400);
            }
            return redirect()->back()->with('error', 'Something went wrong');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $jsonData = JsonData::where(['uuid' => $uuid])->first();
        if (!$jsonData) {
            if (\request()->ajax()) {
                return response()->json(['success' => false, 'message' => 'Data not found'], 404);
            } else {
                return redirect()->route('json.index')->with('error', 'Data not found');
            }
        }

        $data = json_decode(json_encode($jsonData->data), true);
        $view = view('json.show', compact('data'));
        if (\request()->ajax()) {
            return $view->render();
        }

        return view('json.index', compact('view'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        try {
            $this->jsonDataRepository->destroyJsonData($uuid);
            return redirect()->back()->with('success', 'Data deleted successfully');
        } catch (Exception $exception) {
            return redirect()->back()->with('error', 'Something went wrong');
        }

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
